<?php

namespace Modules\Taxido\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Broadcasts\DriverRideRequestBroadcast;
use Modules\Taxido\Enums\RideStatusEnum;
use Modules\Taxido\Models\RideRequest;


class CheckDriverTimeoutJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;

    public function __construct(
        protected int $rideRequestId,
        protected int $driverId
    ) {}

    public function handle(): void
    {
        $rideRequest = RideRequest::findOrFail($this->rideRequestId);
        if (!$rideRequest) {
            return;
        }

        if ((int) $rideRequest->current_driver_id !== $this->driverId) {
            Log::info("CheckDriverTimeoutJob: Driver #{$this->driverId} is no longer current for ride #{$rideRequest->ride_number}. Skipping.");
            return;
        }

        $currentStatus = $rideRequest->ride_status_activities()
            ->latest('changed_at')
            ->value('status');

        $activeStatuses = [RideStatusEnum::REQUESTED, RideStatusEnum::PENDING];
        if (!in_array($currentStatus, $activeStatuses)) {
            Log::info("CheckDriverTimeoutJob: Ride #{$rideRequest->ride_number} status is '{$currentStatus}'. No action needed.");
            return;
        }

        Log::info("CheckDriverTimeoutJob: Driver #{$this->driverId} timed out for ride #{$rideRequest->ride_number}.");
        event(new DriverRideRequestBroadcast($rideRequest, $this->driverId, 'timeout'));
        $rejected = $rideRequest->rejected_driver_ids ?? [];
        if (!in_array($this->driverId, $rejected)) {
            $rejected[] = $this->driverId;
        }

        $rideRequest->update([
            'current_driver_id'            => null,
            'rejected_driver_ids'          => array_values($rejected),
            'driver_acceptance_expires_at' => null,
        ]);

        AssignNextDriverJob::dispatch($this->rideRequestId);
    }
}
