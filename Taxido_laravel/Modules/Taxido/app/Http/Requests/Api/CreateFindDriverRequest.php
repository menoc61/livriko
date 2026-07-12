<?php

namespace Modules\Taxido\Http\Requests\Api;

use App\Exceptions\ExceptionHandler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateFindDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'location_coordinates' => 'required|array|min:1',
            'location_coordinates.*.lat' => 'required|numeric',
            'location_coordinates.*.lng' => 'required|numeric',

            'locations' => 'required|array|min:1',
            'locations.*' => 'required|string',

            'service_id' => 'required|integer|exists:services,id',
            'service_category_id' => 'required|integer|exists:service_categories,id',

            'vehicle_type_id' => 'required|integer|exists:vehicle_types,id',
            'gear_type' => 'nullable|in:automatic,manual',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ExceptionHandler($validator->errors()->first(), 422);
    }
}
