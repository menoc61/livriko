<?php

namespace Modules\Taxido\Broadcasts;

use Modules\Taxido\Models\Bid;
use Modules\Taxido\Models\Ride;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Taxido\Http\Resources\RideDetailResource;

class BiddingStatusBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public ?Ride $ride, public Bid $bid) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('bid-status.' . $this->bid->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'bid.status';
    }

    public function broadcastWith(): array
    {
        $rideResource = $this->ride ? (new RideDetailResource($this->ride))->toArray(request()) : [];
        return array_merge($rideResource, [
            'bid' => [
                'id'              => $this->bid->id,
                'ride_id'         => $this->ride?->id,
                'ride_request_id' => $this->bid->ride_request_id,
                'driver_id'       => $this->bid->driver_id,
                'amount'          => $this->bid->amount,
                'status'          => $this->bid->status,
                'message'         => 'Your bid was ' . $this->bid->status . '.',
            ]
        ]);
    }
}
