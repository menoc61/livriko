<?php

namespace Modules\Taxido\Broadcasts;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DocumentVerifyBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $is_verified;

    /**
     * Create a new event instance.
     *
     * @param int $is_verified
     * @param string|null $message
     */
    public function __construct($user, int $is_verified, string $message = null)
    {
        $this->user = $user;
        $this->is_verified = $is_verified;
        $this->message = $message ?? ($is_verified ? __('Document Verified') : __('Document Verification Pending'));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('document-verification.' . $this->user->id),
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'document.verified.' . $this->user?->id;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'user_id' => (string) $this->user->id,
            'is_verified' => (int) $this->is_verified,
            'message' => $this->message,
            'role' => $this->user->getRoleNames()?->first(),
        ];
    }
}
