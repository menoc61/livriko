<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

Broadcast::channel('chat.room.{roomId}', function ($user, $roomId) {
    $room = DB::table('chat_rooms')
        ->where('room_id', $roomId)
        ->first();

    if (!$room) {
        // Allow joining if the user ID is part of the room ID convention {id1}_{id2}
        $ids = explode('_', $roomId);
        return in_array((string) $user->id, $ids);
    }

    $participants = json_decode($room->participants, true);
    return is_array($participants) && in_array((string) $user->id, $participants);
});


Broadcast::channel('user.notifications.{userId}', function ($user, $userId) {
    return (string) $user->id === (string) $userId;
});

