<?php

namespace Modules\Taxido\Broadcasts;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class BidAcceptedOnRideRequestBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  int  $rideRequestId  The ride request that had the accepted bid.
     * @param  int  $bidId          The accepted bid ID.
     * @param  int  $rideId         The ride created as a result.
     */
    public function __construct(
        public readonly int $rideRequestId,
        public readonly int $bidId,
        public readonly int $rideId
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ride-request.' . $this->rideRequestId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'bid.status';
    }

    public function broadcastWith(): array
    {
        return [
            'bid_id'          => $this->bidId,
            'ride_id'         => $this->rideId,
            'ride_request_id' => $this->rideRequestId,
            'status'          => 'accepted',
        ];
    }
}
