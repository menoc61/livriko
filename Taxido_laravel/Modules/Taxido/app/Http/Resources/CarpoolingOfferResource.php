<?php

namespace Modules\Taxido\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarpoolingOfferResource extends JsonResource
{
    public $showSensitiveAttributes = true;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'driver_id' => $this->driver_id,
            'vehicle_type_id' => $this->vehicle_type_id,
            'total_seats' => $this->total_seats,
            'available_seats' => $this->available_seats,
            'discount' => $this->discount,
            'start_date' => $this->start_date?->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'pickup_location' => $this->pickup_location,
            'pickup_lat' => $this->pickup_lat,
            'pickup_lng' => $this->pickup_lng,
            'dropoff_location' => $this->dropoff_location,
            'dropoff_lat' => $this->dropoff_lat,
            'dropoff_lng' => $this->dropoff_lng,
            'available_area' => $this->available_area,
            'km_range' => $this->km_range,
            'is_active' => $this->is_active,
            'preferences' => $this->preferences,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'driver' => [
                'id' => $this->whenLoaded('driver', fn() => $this->driver->id),
                'name' => $this->whenLoaded('driver', fn() => $this->driver->name),
                'profile_image_url' => $this->whenLoaded('driver', fn() => $this->driver->profile_image?->original_url),
                'rating_count' => $this->whenLoaded('driver', fn() => $this->driver->rating_count),
                'review_count' => $this->whenLoaded('driver', fn() => $this->driver->review_count),
                'phone' => $this->whenLoaded('driver', fn() => $this->driver->phone),
                'country_code' => $this->whenLoaded('driver', fn() => $this->driver->country_code),
            ],
            'vehicle_type' => [
                'id' => $this->whenLoaded('vehicleType', fn() => $this->vehicleType->id),
                'name' => $this->whenLoaded('vehicleType', fn() => $this->vehicleType->name),
                'max_seat' => $this->whenLoaded('vehicleType', fn() => $this->vehicleType->max_seat),
                'capacity' => $this->whenLoaded('vehicleType', fn() => $this->vehicleType->max_seat),
                'vehicle_map_icon_url' => $this->whenLoaded('vehicleType', fn() => $this->vehicleType->vehicle_map_icon?->original_url),
            ],
        ];
    }
}
