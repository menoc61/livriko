<?php

namespace Modules\Taxido\Broadcasts;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * RideRequestStatusUpdateBroadcast
 * ─────────────────────────────────────────────────────────────────────────────
 * Sent on `ride-request.{rideRequestId}` when the ride request status changes
 * (e.g. accepted, cancelled). Used primarily in the bidding flow so the rider's
 * ride-request channel receives a status echo after ride creation.
 *
 * Channel : private  ride-request.{rideRequestId}
 * Event   : ride.status_update
 * Trigger : RideTrait::broadcastRideAcceptance()
 */
class RideRequestStatusUpdateBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  int    $rideRequestId  The ride request being updated.
     * @param  int    $rideId         The ride created from this request.
     * @param  string $status         New status string (e.g. 'accepted').
     */
    public function __construct(
        public readonly int    $rideRequestId,
        public readonly int    $rideId,
        public readonly string $status
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ride-request.' . $this->rideRequestId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'ride.status_update';
    }

    public function broadcastWith(): array
    {
        return [
            'id'      => $this->rideRequestId,
            'ride_id' => $this->rideId,
            'status'  => $this->status,
        ];
    }
}
