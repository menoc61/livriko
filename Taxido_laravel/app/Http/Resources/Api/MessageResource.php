<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use App\Http\Resources\BaseResource;

class MessageResource extends BaseResource
{
  protected $showSensitiveAttributes = true;

  public static $wrap = null;

  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'room_id' => $this->room_id,
      'receiver_id' => $this->receiver_id,
      'sender_id' => $this->sender_id,
      'sender_name' => $this->sender_name,
      'receiver_name' => $this->receiver_name,
      'message' => $this->message,
      'images' => $this->images,
      'is_read' => $this->is_read,
      'created_at' => $this->created_at,
    ];
  }
}
