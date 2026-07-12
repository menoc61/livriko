<?php

namespace Modules\Taxido\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class NotificationLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'notification_type',
        'template_slug',
        'placeholders',
        'status',
        'error_message',
        'retry_count',
    ];

    protected $casts = [
        'placeholders' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
