<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * GenericBroadcastEvent
 * ─────────────────────────────────────────────────────────────────────────────
 * A versatile, reusable event for any real-time communication.
 */
class GenericBroadcastEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $channelName;
    public $eventName;
    public $isPrivate;

    /**
     * Create a new event instance.
     */
    public function __construct(string $channelName, string $eventName, array $data = [], bool $isPrivate = true)
    {
        $this->channelName = $channelName;
        $this->eventName   = $eventName;
        $this->data        = $data;
        $this->isPrivate   = $isPrivate;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return $this->isPrivate 
            ? [new PrivateChannel($this->channelName)] 
            : [new Channel($this->channelName)];
    }

    /**
     * The event name to broadcast as.
     */
    public function broadcastAs(): string
    {
        return $this->eventName;
    }

    /**
     * Data to broadcast.
     */
    public function broadcastWith(): array
    {
        return $this->data;
    }
}
