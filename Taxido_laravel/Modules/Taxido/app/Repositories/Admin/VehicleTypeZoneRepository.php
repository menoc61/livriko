<?php

namespace Modules\Taxido\Repositories\Admin;

use Illuminate\Support\Facades\Validator;
use Modules\Taxido\Models\VehicleType;
use Modules\Taxido\Models\Service;
use Modules\Taxido\Enums\ServicesEnum;
use Modules\Taxido\Models\VehicleTypeZone;
use Prettus\Repository\Eloquent\BaseRepository;

class VehicleTypeZoneRepository extends BaseRepository
{
    public function model()
    {
        return VehicleTypeZone::class;
    }

    public function index($vehicleTypeId)
    {
        return VehicleTypeZone::where('vehicle_type_id', $vehicleTypeId)->with('zone')->get();
    }

    public function vehicleZonePriceIndex($vehicleTypeId, $zoneId)
    {
        return VehicleTypeZone::where('vehicle_type_id', $vehicleTypeId)->with(['preferences'])->where('zone_id', $zoneId)->with('zone')->get();
    }

    public function vehicleZonePriceShow($vehicleTypeId, $zoneId)
    {
        $vehicleTypeZone = VehicleTypeZone::where('vehicle_type_id', $vehicleTypeId)
            ->with(['preferences'])
            ->where('zone_id', $zoneId)
            ->first();

        return response()->json([
            'success' => true,
            'vehicleTypeZone' => $vehicleTypeZone
        ]);
    }

    public function vehicleZonePriceStore($request)
    {
        $vehicleType = VehicleType::find($request->vehicle_type_id);
        $service = Service::find($vehicleType?->service_id);
        $isFindDriver = $service?->type == ServicesEnum::FINDDRIVER;

        $validator = Validator::make($request->all(), [
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'zone_id' => 'required|exists:zones,id',
            'base_fare_charge' => $isFindDriver ? 'nullable|numeric' : 'required|numeric|min:0',
            'base_distance' => $isFindDriver ? 'nullable|numeric' : 'required|numeric|min:0',
            'is_allow_tax' => 'required|boolean',
            'tax_id' => 'nullable|exists:taxes,id',
            'per_distance_charge' => $isFindDriver ? 'nullable|numeric' : 'required|numeric|min:0',
            'per_minute_charge' => $isFindDriver ? 'nullable|numeric' : 'required|numeric|min:0',
            'per_weight_charge' => 'nullable|numeric|min:0',
            'waiting_charge' => 'nullable|numeric|min:0',
            'free_waiting_time_before_start_ride' => 'nullable|numeric|min:0',
            'free_waiting_time_after_start_ride' => 'nullable|numeric|min:0',
            'is_allow_airport_charge' => $isFindDriver ? 'nullable|boolean' : 'required|boolean',
            'cancellation_charge_for_rider' => 'nullable|numeric|min:0',
            'cancellation_charge_for_driver' => 'nullable|numeric|min:0',
            'charge_goes_to' => 'required|in:rider,driver,admin',
            'airport_id' => 'nullable|exists:airports,id',
            'commission_type' => 'nullable|string',
            'commission_rate' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('preferences');
        if ($isFindDriver) {
            $data['base_fare_charge'] = 0;
            $data['base_distance'] = 0;
            $data['per_distance_charge'] = 0;
            $data['per_minute_charge'] = 0;
            $data['per_weight_charge'] = 0;
            $data['is_allow_airport_charge'] = false;
            $data['is_allow_preference'] = false;
        } else {
            $data['is_allow_preference'] = $request->input('is_allow_preference', false);
        }

        $vehicleTypeZone = VehicleTypeZone::create($data);

        // Sync preferences
        if (!$isFindDriver && $request->has('preferences') && $data['is_allow_preference']) {
            $preferences = collect($request->preferences)->mapWithKeys(function ($item) {
                return [$item['id'] => ['price' => $item['price']]];
            })->toArray();
            $vehicleTypeZone->preferences()->sync($preferences);
        } else {
            $vehicleTypeZone->preferences()->detach();
        }

        return response()->json([
            'success' => true,
            'vehicleTypeZone' => $vehicleTypeZone
        ]);
    }

    public function vehicleZonePriceUpdate($request, $vehicleTypeZone)
    {
        $vehicleType = VehicleType::find($request->vehicle_type_id);
        $service = Service::find($vehicleType?->service_id);
        $isFindDriver = $service?->type == ServicesEnum::FINDDRIVER;

        $validator = Validator::make($request->all(), [
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'zone_id' => 'required|exists:zones,id',
            'base_fare_charge' => $isFindDriver ? 'nullable|numeric' : 'required|numeric|min:0',
            'base_distance' => $isFindDriver ? 'nullable|numeric' : 'required|numeric|min:0',
            'is_allow_tax' => 'required|boolean',
            'per_distance_charge' => $isFindDriver ? 'nullable|numeric' : 'required|numeric|min:0',
            'per_minute_charge' => $isFindDriver ? 'nullable|numeric' : 'required|numeric|min:0',
            'per_weight_charge' => 'nullable|numeric|min:0',
            'waiting_charge' => 'nullable|numeric|min:0',
            'free_waiting_time_before_start_ride' => 'nullable|numeric|min:0',
            'free_waiting_time_after_start_ride' => 'nullable|numeric|min:0',
            'is_allow_airport_charge' => $isFindDriver ? 'nullable|boolean' : 'required|boolean',
            'cancellation_charge_for_rider' => 'nullable|numeric|min:0',
            'cancellation_charge_for_driver' => 'nullable|numeric|min:0',
            'charge_goes_to' => 'required|in:rider,driver,admin',
            'commission_type' => 'nullable|string',
            'commission_rate' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('preferences');
        if ($isFindDriver) {
            $data['base_fare_charge'] = 0;
            $data['base_distance'] = 0;
            $data['per_distance_charge'] = 0;
            $data['per_minute_charge'] = 0;
            $data['per_weight_charge'] = 0;
            $data['is_allow_airport_charge'] = false;
            $data['is_allow_preference'] = false;
        } else {
            $data['is_allow_preference'] = $request->input('is_allow_preference', false);
        }
        
        $vehicleTypeZone->update($data);

        // Sync preferences
        if (!$isFindDriver && $request->has('preferences') && $data['is_allow_preference']) {
            $preferences = collect($request->input('preferences'))->mapWithKeys(function ($item) {
                return [$item['id'] => ['price' => $item['price']]];
            })->toArray();
            $vehicleTypeZone->preferences()->sync($preferences);
        } else {
            $vehicleTypeZone->preferences()->detach();
        }

        return response()->json([
            'success' => true,
            'vehicleTypeZone' => $vehicleTypeZone
        ]);
    }
}
