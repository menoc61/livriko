<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatRoom extends Model
{
    protected $table = 'chat_rooms';

    protected $fillable = [
        'room_id',
        'participants',
        'last_message',
        'unread_count',
    ];

    protected $casts = [
        'participants' => 'json',
        'last_message' => 'json',
        'unread_count' => 'json', // { "user_id": 5 }
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'room_id', 'room_id');
    }

    /**
     * Mark all messages in the room as read for the user.
     */
    public function markAsRead(int $userId): void
    {
        $unreadCount = $this->unread_count ?? [];
        $unreadCount[(string) $userId] = 0;
        
        $this->update(['unread_count' => $unreadCount]);
        
        Message::where('room_id', $this->room_id)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    /**
     * Increment unread count for the receiver.
     */
    public function incrementUnread(int $receiverId): void
    {
        $unreadCount = $this->unread_count ?? [];
        $key = (string) $receiverId;
        $unreadCount[$key] = ($unreadCount[$key] ?? 0) + 1;
        
        $this->update(['unread_count' => $unreadCount]);
    }
}
