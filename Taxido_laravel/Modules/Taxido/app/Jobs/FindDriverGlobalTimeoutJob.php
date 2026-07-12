<?php

namespace Modules\Taxido\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Broadcasts\DriverRideRequestBroadcast;
use Modules\Taxido\Enums\RideStatusEnum;
use Modules\Taxido\Models\RideRequest;
use Modules\Taxido\Broadcasts\RideNoDriverFoundBroadcast;


class FindDriverGlobalTimeoutJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;

    public function __construct(protected int $rideRequestId) {}

    public function handle(): void
    {
        $rideRequest = RideRequest::findOrFail($this->rideRequestId);
        if (!$rideRequest) {
            return;
        }

        $currentStatus = $rideRequest->ride_status_activities()
            ->latest('changed_at')
            ->value('status');

        $activeStatuses = [RideStatusEnum::REQUESTED, RideStatusEnum::PENDING];
        if (!in_array($currentStatus, $activeStatuses)) {
            Log::info("FindDriverGlobalTimeoutJob: Ride #{$rideRequest->ride_number} already in status '{$currentStatus}'. No action needed.");
            return;
        }

        // Capture before we null it out
        $currentDriverId = $rideRequest->current_driver_id;

        $rideRequest->ride_status_activities()->create([
            'status'     => RideStatusEnum::CANCELLED,
            'changed_at' => now(),
        ]);

        $rideRequest->update([
            'current_driver_id'            => null,
            'driver_acceptance_expires_at' => null,
        ]);

        broadcast(new RideNoDriverFoundBroadcast($rideRequest));

        if ($currentDriverId) {
            try {
                event(new DriverRideRequestBroadcast(
                    $rideRequest->fresh(),
                    (int) $currentDriverId,
                    'cancelled'
                ));
            } catch (Exception $e) {
                Log::warning("FindDriverGlobalTimeoutJob: Could not notify driver #{$currentDriverId}: " . $e->getMessage());
            }
        }

        Log::info("FindDriverGlobalTimeoutJob: Ride #{$rideRequest->ride_number} cancelled and all parties notified.");
    }
}
