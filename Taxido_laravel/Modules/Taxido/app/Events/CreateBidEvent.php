<?php

namespace Modules\Taxido\Events;

use Modules\Taxido\Models\Driver;
use Modules\Taxido\Models\RideRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class CreateBidEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rideRequest;
    public $driver;
    public $bid;

    public function __construct(RideRequest $rideRequest, Driver $driver, $bid)
    {
        $this->rideRequest = $rideRequest;
        $this->driver      = $driver;
        $this->bid   = $bid;
    }

    /**
     * Broadcast on the ride request's private channel.
     * The rider is already subscribed here from the moment the ride request is created.
     * Channel auth in channels.php allows rider_id OR whitelisted driver.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ride-request.' . $this->rideRequest->id),
        ];
    }

    /**
     * Event name the rider app listens for.
     */
    public function broadcastAs(): string
    {
        return 'bid.new';
    }

    /**
     * Payload sent to the rider — everything needed to render a bid card.
     */
    public function broadcastWith(): array
    {
        return [
            'bid_id'           => $this->bid?->id,
            'ride_request_id' => $this->rideRequest->id,
            'ride_number'     => $this->rideRequest->ride_number,
            'driver_id'       => (string) $this->driver->id,
            'driver_name'     => $this->driver->name,
            'driver_phone'    => $this->driver->phone,
            'rating_count'    => $this->driver->rating_count,
            'review_count'    => $this->driver->review_count,
            'profile_image_url' => $this->driver->profile_image?->original_url,
            'plate_number'    => $this->driver->vehicle_info?->plate_number,
            'model'           => $this->driver->vehicle_info?->model,
            'vehicle_type_map_icon_url' => $this->driver->vehicle_info?->vehicle?->vehicle_map_icon?->original_url,
            'bid_amount'      => (float) $this->bid?->amount,
        ];
    }
}
