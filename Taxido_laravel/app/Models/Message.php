<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Message extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'chat_messages';

    protected $fillable = [
        'room_id',
        'sender_id',
        'receiver_id',
        'sender_name',
        'receiver_name',
        'message',
        'images',
        'is_read',
        'cleared_by',
    ];

    protected $casts = [
        'images' => 'json',
        'cleared_by' => 'json',
        'is_read' => 'boolean',
    ];

    protected $appends = [
        'images',
    ];

    public function getImagesAttribute()
    {
        $media = $this->getMedia('chat_images');
        if ($media->count() > 0) {
            return $media->map(fn($item) => $item->original_url)->toArray();
        }
        
        $value = $this->attributes['images'] ?? null;
        if ($value) {
            return is_string($value) ? json_decode($value, true) : $value;
        }

        return [];
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(ChatRoom::class, 'room_id', 'room_id');
    }
}
