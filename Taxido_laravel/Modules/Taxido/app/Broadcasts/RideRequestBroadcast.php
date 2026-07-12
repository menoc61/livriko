<?php

namespace Modules\Taxido\Broadcasts;

use Illuminate\Queue\SerializesModels;
use Modules\Taxido\Models\RideRequest;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Taxido\Http\Resources\Drivers\RideRequestResource;

class RideRequestBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public RideRequest $rideRequest) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ride-request-status.' . $this->rideRequest?->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'ride.request.status';
    }

    public function broadcastWith(): array
    {
        return (new  RideRequestResource($this->rideRequest))->toArray(request());
    }
}
