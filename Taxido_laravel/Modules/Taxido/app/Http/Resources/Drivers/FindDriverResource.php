<?php

namespace Modules\Taxido\Http\Resources\Drivers;

use Illuminate\Http\Request;
use App\Http\Resources\BaseResource;

class FindDriverResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'profile_image_url' => $this->profile_image?->original_url,
            'rating_count' => (float) $this->rating_count,
            'review_count' => (int) $this->review_count,
            'reviews' => $this->reviews,
            'price' => (float) $this->price,
            'total' => (float) ($this->total ?? 0),
            'driver_charge' => (float) ($this->driver_charge ?? 0),
            'admin_commission' => (float) ($this->admin_commission ?? 0),
            'tax' => (float) ($this->tax ?? 0),
            'ride_fare' => (float) ($this->ride_fare ?? 0),
            'currency_symbol' => $this->currency_symbol ?? '',
            'price_type' => $this->price_type,
            'per_km_charge' => (float) $this->per_km_charge,
            'per_hour_charge' => (float) $this->per_hour_charge,
            'per_day_charge' => (float) $this->per_day_charge,
            'distance' => $this->distance,
            'distance_unit' => $this->distance_unit,
            'duration'=> $this->duration,
            'outstation_type'=> $this->outstation_type

        ];

    }
}
