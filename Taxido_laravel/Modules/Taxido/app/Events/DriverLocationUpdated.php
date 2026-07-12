<?php

namespace Modules\Taxido\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * DriverLocationUpdated
 * ─────────────────────────────────────────────────────────────────────────────
 * Real-time event for high-frequency driver location updates.
 * Optimized for React Native tracking.
 * Located in Taxido module.
 */
class DriverLocationUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $driverId;
    public $location;
    public $metadata;

    /**
     * Create a new event instance.
     */
    public function __construct(int $driverId, array $location, array $metadata = [])
    {
        $this->driverId = $driverId;
        $this->location = $location;
        $this->metadata = $metadata;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PresenceChannel("driver-notification.{$this->driverId}"),
            new Channel("drivers-map"), 
        ];
    }

    /**
     * Minimize the data sent over the socket.
     */
    public function broadcastWith(): array
    {
        return array_merge([
            'id'             => $this->driverId,
            'lat'            => (float) ($this->location['lat'] ?? 0),
            'lng'            => (float) ($this->location['lng'] ?? 0),
            'bearing'        => (float) ($this->location['bearing'] ?? 0),
            'updated_at'     => now()->toIso8601String(),
        ], $this->metadata);
    }

    /**
     * The event name in Echo.
     */
    public function broadcastAs(): string
    {
        return 'driver.location_updated';
    }
}
