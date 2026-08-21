<?php

namespace Modules\Taxido\Http\Requests\Api;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class CreateCarpoolingOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $offerId = $this->route('offer')?->id;

        return [
            'vehicle_type_id' => ['nullable', 'exists:vehicle_types,id,deleted_at,NULL'],
            'total_seats' => ['required', 'integer', 'min:1', 'max:10'],
            'available_seats' => ['required', 'integer', 'min:0'],
            'discount' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'pickup_location' => ['nullable', 'string', 'max:255'],
            'pickup_lat' => ['nullable', 'numeric'],
            'pickup_lng' => ['nullable', 'numeric'],
            'dropoff_location' => ['nullable', 'string', 'max:255'],
            'dropoff_lat' => ['nullable', 'numeric'],
            'dropoff_lng' => ['nullable', 'numeric'],
            'available_area' => ['nullable', 'string', 'max:255'],
            'km_range' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
            'preferences' => ['nullable', 'array'],
        ];
    }
}
