<?php

namespace Modules\Taxido\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Broadcasts\DriverRideRequestBroadcast;
use Modules\Taxido\Enums\RideStatusEnum;
use Modules\Taxido\Models\Driver;
use Modules\Taxido\Models\RideRequest;
use Modules\Taxido\Notifications\InstantRideRequestNotification;
use Modules\Taxido\Services\DriverStateService;
use Modules\Taxido\Broadcasts\RideNoDriverFoundBroadcast;

/**
 * AssignNextDriverJob
 * ─────────────────────────────────────────────────────────────────────────────
 * implements the instant-ride sequential driver assignment chain.
 *
 * Flow:
 *  1. Load RideRequest from MySQL — bail if already accepted / cancelled.
 *  2. Fetch the initial eligible driver pool from `ride_request_drivers`.
 *  3. Subtract `rejected_driver_ids` (already stored in MySQL).
 *  4. Re-sort remaining candidates by Redis GEO proximity (DriverStateService).
 *  5a. If none remain → immediately cancel the ride, notify rider via Reverb.
 *  5b. Otherwise → assign next driver (MySQL), broadcast via Reverb (Reverb),
 *      send FCM push, dispatch CheckDriverTimeoutJob with per-driver TTL.
 *
 */
class AssignNextDriverJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 5;

    public function __construct(protected int $rideRequestId) {}

    public function handle(): void
    {
        $rideRequest = RideRequest::find($this->rideRequestId);
        if (!$rideRequest) {
            Log::warning("AssignNextDriverJob: RideRequest #{$this->rideRequestId} not found.");
            return;
        }

        // Bail if ride is no longer in an assignable state
        $activeStatuses = [RideStatusEnum::REQUESTED, RideStatusEnum::PENDING];
        $currentStatus  = $rideRequest->ride_status_activities()
            ->latest('changed_at')
            ->value('status');

        if (!in_array($currentStatus, $activeStatuses)) {
            Log::info("AssignNextDriverJob: Ride #{$rideRequest->ride_number} already in status '{$currentStatus}'. Skipping.");
            return;
        }

        $settings           = getTaxidoSettings();
        $acceptanceSeconds  = (int) ($settings['ride']['ride_request_time_driver'] ?? 30);
        $radiusKm           = (float) ($settings['location']['radius_meter'] ?? 10000) / 1000;

        $allDriverIds = DB::table('ride_request_drivers')
            ->where('ride_request_id', $rideRequest->id)
            ->pluck('driver_id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        $rejectedIds    = array_map('strval', $rideRequest->rejected_driver_ids ?? []);
        $eligibleIds    = array_values(array_diff($allDriverIds, $rejectedIds));

        if (empty($eligibleIds)) {
            Log::info("AssignNextDriverJob: No eligible drivers left for ride #{$rideRequest->ride_number}. Cancelling.");
            $this->cancelRide($rideRequest);
            return;
        }

        // Re-sort by Redis GEO proximity (nearest first) + filter online/available
        // is_verified is stored as string '1' in Redis metadata — cast accordingly
        $coordinate     = head($rideRequest->location_coordinates ?? [['lat' => 0, 'lng' => 0]]);
        $nearestDrivers = app(DriverStateService::class)->findNearestDrivers(
            (float) $coordinate['lat'],
            (float) $coordinate['lng'],
            $radiusKm,
            [
                'id'         => $eligibleIds, // string IDs from pivot
                'is_online'  => '1',
                'is_on_ride' => '0',
            ]
        );

        // Fallback: Redis metadata may be stale/expired for some drivers.
        // Check DB directly so we never prematurely cancel a ride.
        if (empty($nearestDrivers)) {
            $fallbackIds = Driver::query()
                ->whereIn('id', array_map('intval', $eligibleIds))
                ->where('is_online', true)
                ->where('is_on_ride', false)
                ->where('is_verified', true)
                ->whereNull('deleted_at')
                ->pluck('id')
                ->toArray();

            if (empty($fallbackIds)) {
                Log::info("AssignNextDriverJob: No online/available drivers for ride #{$rideRequest->ride_number} (Redis+DB). Cancelling.");
                $this->cancelRide($rideRequest);
                return;
            }

            $nearestDrivers = [['id' => (string) $fallbackIds[0]]];
            Log::info("AssignNextDriverJob: Redis miss — DB fallback driver #{$fallbackIds[0]} for ride #{$rideRequest->ride_number}.");
        }

        $nextDriverId = (int) $nearestDrivers[0]['id'];
        $driver       = Driver::find($nextDriverId);

        if (!$driver) {
            Log::warning("AssignNextDriverJob: Driver #{$nextDriverId} not found in DB. Skipping.");
            $this->markRejected($rideRequest, $nextDriverId);
            $remainingCount = DB::table('ride_request_drivers')
                ->where('ride_request_id', $rideRequest->id)
                ->whereNotIn('driver_id', array_merge(
                    array_map('intval', $rejectedIds),
                    [$nextDriverId]
                ))->count();

            if ($remainingCount > 0) {
                self::dispatch($this->rideRequestId);
            } else {
                $this->cancelRide($rideRequest);
            }
            return;
        }

        $rideRequest->update([
            'current_driver_id'            => $nextDriverId,
            'driver_acceptance_expires_at' => now()->addSeconds($acceptanceSeconds),
        ]);

        $rideRequest = $rideRequest->fresh();
        Log::info("AssignNextDriverJob: Assigned driver #{$nextDriverId} to ride #{$rideRequest->ride_number} (expires in {$acceptanceSeconds}s).");
        event(new DriverRideRequestBroadcast($rideRequest, $nextDriverId, 'request'));
        try {
            $driver->notify(new InstantRideRequestNotification($rideRequest));
        } catch (Exception $e) {
            Log::warning("AssignNextDriverJob: FCM notification failed for driver #{$nextDriverId}: " . $e->getMessage());
        }

        CheckDriverTimeoutJob::dispatch($this->rideRequestId, $nextDriverId)->delay(now()->addSeconds($acceptanceSeconds));
    }

    /**
     * Cancel the ride request — no drivers available.
     * Updates MySQL status, notifies rider via Reverb.
     */
    private function cancelRide(RideRequest $rideRequest): void
    {
        try {
            $rideRequest->ride_status_activities()->create([
                'status'     => RideStatusEnum::CANCELLED,
                'changed_at' => now(),
            ]);

            $rideRequest->update([
                'current_driver_id'            => null,
                'driver_acceptance_expires_at' => null,
            ]);

            // Notify rider: no driver found (via Reverb)
            broadcast(new RideNoDriverFoundBroadcast($rideRequest));

            Log::info("AssignNextDriverJob: Ride #{$rideRequest->ride_number} cancelled — no drivers available.");
        } catch (Exception $e) {
            Log::error("AssignNextDriverJob@cancelRide failed: " . $e->getMessage(), [
                'ride_request_id' => $rideRequest->id,
            ]);
        }
    }

    /**
     * Add a driver ID to the rejected list in MySQL without re-dispatching.
     */
    private function markRejected(RideRequest $rideRequest, int $driverId): void
    {
        $rejected   = $rideRequest->rejected_driver_ids ?? [];
        $rejected[] = $driverId;
        $rideRequest->update([
            'rejected_driver_ids' => array_values(array_unique($rejected)),
        ]);
    }
}
