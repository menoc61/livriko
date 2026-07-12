<?php

namespace Modules\Taxido\Broadcasts;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Taxido\Http\Resources\Drivers\RideRequestResource;
use Modules\Taxido\Models\RideRequest;


class DriverRideRequestBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly RideRequest $rideRequest,
        public readonly int $driverId,
        public readonly string $type = 'request'
    ) {}

    /**
     * Private channel per driver — `driver-ride-request-{driverId}`.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('driver-ride-request-' . $this->driverId),
        ];
    }

    /**
     * Consistent event name so driver app can listen once.
     */
    public function broadcastAs(): string
    {
        return 'driver.ride.request';
    }

    /**
     * Full ride request payload + type flag for driver app to branch logic.
     */
    public function broadcastWith(): array
    {
        $data = (new RideRequestResource($this->rideRequest))?->toArray(request());

        return array_merge($data, [
            'type'                         => $this->type,        // 'request'|'timeout'|'cancelled'|'rejected'
            'driver_id'                    => $this->driverId,
            'current_driver_id'            => $this->rideRequest->current_driver_id,
            'driver_acceptance_expires_at' => $this->rideRequest->driver_acceptance_expires_at?->toISOString(),
        ]);
    }
}
