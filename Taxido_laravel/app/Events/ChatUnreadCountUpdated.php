<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatUnreadCountUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $totalUnread;
    public $roomId;
    public $roomUnread;
    public $lastMessage;

    /**
     * Create a new event instance.
     */
    public function __construct($userId, $totalUnread, $roomId = null, $roomUnread = null, $lastMessage = null)
    {
        $this->userId = $userId;
        $this->totalUnread = $totalUnread;
        $this->roomId = $roomId;
        $this->roomUnread = $roomUnread;
        $this->lastMessage = $lastMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("user.notifications.{$this->userId}"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'unread.count.updated';
    }
}
