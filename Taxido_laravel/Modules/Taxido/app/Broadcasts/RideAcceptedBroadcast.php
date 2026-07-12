<?php

namespace Modules\Taxido\Broadcasts;

use Modules\Taxido\Models\Ride;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Taxido\Http\Resources\RideDetailResource;


class RideAcceptedBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly Ride  $ride,
        public readonly int   $riderId,
        public readonly array $driverData = []
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('rider.' . $this->riderId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'ride.accepted';
    }

    public function broadcastWith(): array
    {
        $rideResource = (new RideDetailResource($this->ride))->toArray(request());

        return array_merge($rideResource, $this->driverData, [
            'current_driver_id' => (string) $this->ride->driver_id,
        ]);
    }
}
