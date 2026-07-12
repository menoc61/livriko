<?php

namespace Modules\Taxido\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Modules\Taxido\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $driverId = $this->route('driver') ? $this->route('driver')->id : $this->id;
        $rules = [
            'profile_image_id' => ['nullable','exists:media,id,deleted_at,NULL'],
            'name' => ['required','max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($driverId)
                    ->whereNull('deleted_at')
            ],
            'phone' => [
                'required',
                'max:255',
                Rule::unique('users')
                    ->ignore($driverId)
                    ->whereNull('deleted_at')
                    ->where(function ($query) {
                        $query->where('country_code', request('country_code'));
                    }),
            ],
            'address.address' => ['required'],
            'address.country_id' => ['required','exists:countries,id'],
            'address.state' => ['required'],
            'address.city' => ['required'],
            'address.postal_code' => ['required'],
            'payment_account.bank_account_no' => ['required'],
            'payment_account.bank_name' => ['required'],
            'payment_account.bank_holder_name' => ['required'],
            'payment_account.swift' => ['required'],
            'payment_account.routing_number' => ['required'],
            'experience' => ['required_if:experience,==,' . Service::where('slug', 'find-driver')->value('id')],
            'service_id' => ['required','exists:services,id,deleted_at,NULL'],
            'service_category_id' => ['required','exists:service_categories,id,deleted_at,NULL'],
            'vehicle_type_id' => ['required_if:vehicle_type_id,!=,find-driver','exists:vehicle_types,id,deleted_at,NULL'],
            'gear_type' => [ 'required_if:gear_type,find-driver', 'in:automatic,manual'],
        ];

        if (!$this->isAmbulanceService() && !$this->isFindDriverService()) {
            $rules['vehicle_info.vehicle_type_id'] = ['nullable','exists:vehicle_types,id,deleted_at,NULL'];
            $rules['vehicle_info.model'] = ['nullable'];
            $rules['vehicle_info.plate_number'] = ['nullable'];
            $rules['vehicle_info.seat'] = ['nullable'];
            $rules['vehicle_info.color'] = ['nullable'];
        }

        if ($this->isFindDriverService()) {
            $rules['vehicle_info.vehicle_type_id'] = ['required','exists:vehicle_types,id,deleted_at,NULL'];
        }

        return $rules;
    }

    protected function isAmbulanceService()
    {
        $ambulanceServiceId = Service::where('slug', 'ambulance')?->value('id');
        return $this->input('service_id') == $ambulanceServiceId;
    }

    protected function isFindDriverService()
    {
        $findDriverServiceId = Service::where('type', 'finddriver')?->value('id');
        return $this->input('service_id') == $findDriverServiceId;
    }

}
