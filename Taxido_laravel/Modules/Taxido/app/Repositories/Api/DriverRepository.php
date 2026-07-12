<?php
namespace Modules\Taxido\Repositories\Api;

use Exception;
use Carbon\Carbon;
use App\Services\SocketService;
use App\Exceptions\ExceptionHandler;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Modules\Taxido\Enums\RoleEnum;
use Modules\Taxido\Enums\ServiceCategoryEnum;
use Modules\Taxido\Enums\ServicesEnum;
use Modules\Taxido\Http\Resources\FleetManagers\DriverResource;
use Modules\Taxido\Http\Traits\RideRequestTrait;
use Modules\Taxido\Http\Traits\RideTrait;
use Modules\Taxido\Models\Ambulance;
use Modules\Taxido\Models\Document;
use Modules\Taxido\Models\Driver;
use Modules\Taxido\Models\VehicleInfo;
use Modules\Taxido\Models\VehicleTypeZone;
use Prettus\Repository\Eloquent\BaseRepository;
use Modules\Taxido\Services\DriverStateService;
use Modules\Taxido\Events\DriverLocationUpdated;


class DriverRepository extends BaseRepository
{
    use RideRequestTrait, RideTrait;

    public function model()
    {
        return Driver::class;
    }

    public function show($id)
    {
        try {

            return $this->model->findOrFail($id);

        } catch (Exception $e) {

            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }


    public function updateLocation($request)
    {
        try {


            $driver = getCurrentDriver();
            if (!$driver) {
                return ['success' => false, 'error' => 'Driver not found'];
            }

            $locate = $request->location;
            $is_online = $request->input('is_online');
            $statusChanged = false;
            if (isset($is_online)) {
                $statusChanged = $driver->is_online != $is_online;
                $driver->update([
                    'is_online' => $is_online,
                ]);
            }

            $broadcastLocate = null;
            if (isset($locate['lat']) && isset($locate['lng'])) {
                $broadcastLocate = $locate;
                $cacheKey = "driver_location_db_sync_{$driver->id}";
                if (!Cache::has($cacheKey)) {
                    $driver->update([
                        'location' => [$locate],
                    ]);
                    Cache::put($cacheKey, true, 60);
                }
            } elseif ($statusChanged) {
                $currentLoc = $driver->location;
                if ($currentLoc && isset($currentLoc[0]['lat'])) {
                    $broadcastLocate = $currentLoc[0];
                }
            }

            if ($broadcastLocate) {
                $driverState = app(DriverStateService::class);
                $driverState->updateDriverLocation(
                    $driver->id,
                    (float) $broadcastLocate['lat'],
                    (float) $broadcastLocate['lng'],
                    [
                        'id' => (string) $driver->id,
                        'is_online' => $driver->is_online ? '1' : '0',
                        'is_verified' => $driver->is_verified ? '1' : '0',
                        'is_on_ride' => $driver->is_on_ride ? '1' : '0',
                        'service_id' => $driver->service_id ? '1' : '0',
                        'service_category_id' => $driver->service_category_id ? '1' : '0',
                    ]
                );

                event(new DriverLocationUpdated($driver->id, $broadcastLocate, [
                    'is_online' => $driver->is_online,
                    'is_on_ride' => $driver->is_on_ride,
                ]));
            }

            return ['success' => true, 'is_online' => (int) $driver->is_online];

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function driverZone($request)

    {
        DB::beginTransaction();
        try {

            $zoneIds = [];
            $isValid = false;
            $locations = $request->locations;
            if (is_array($locations)) {
                $locate = head($locations);
                if ((!is_null($locate['lat']) && !is_null($locate['lng']))) {
                    $isValid = true;
                }
            }

            if ($isValid) {
                $driver = getCurrentDriver();
                if ($driver) {
                    $driver->update([
                        'is_online' => $request->is_online,
                        'location' => $request->locations,
                    ]);

                    foreach ($locations as $location) {
                        $zones = getZoneByPoint($location['lat'], $location['lng']);
                        if (!$zones->isEmpty()) {
                            foreach ($zones as $zone) {
                                $zoneIds[] = $zone?->id;
                            }
                        }
                    }

                    if (!empty($zoneIds)) {
                        $driver->zones()->sync([]);
                        $driver->zones()->sync(array_unique($zoneIds));
                    }

                    DB::commit();
                    $driverState = app(DriverStateService::class);
                    $driverState->updateDriverLocation(
                        $driver->id,
                        (float) $locate['lat'],
                        (float) $locate['lng'],
                        [
                            'id' => (string) $driver->id,
                            'is_online' => $request->is_online ? '1' : '0',
                            'is_on_ride' => $driver->is_on_ride ? '1' : '0',
                            'is_verified' => $driver->is_verified ? '1' : '0',
                            'service_id' => $driver->service_id,
                            'service_category_id' => $driver->service_category_id,
                            'vehicle_type_id' => $driver->vehicle_type_id,
                        ]
                    );

                    // Broadcast high-frequency location update
                    event(new DriverLocationUpdated($driver->id, $locate, [
                        'is_online' => $request->is_online,
                        'is_on_ride' => $driver->is_on_ride,
                    ]));

                    return [
                        'success' => true,
                    ];
                }
            }

            DB::rollback();

            return [
                'success' => false,
            ];

        } catch (Exception $e) {

            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function getAmbulance($request)
    {
        try {

            if ($request->lat && $request->lng) {
                $driverIds = $this->findNearestDrivers($request->lat, $request->lng, []);
                return Ambulance::whereNull('deleted_at')?->whereIn('driver_id', $driverIds)?->simplePaginate();
            }

            throw new Exception('lat and lng field is required.', 422);
        } catch (Exception $e) {

            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function getNearestDrivers($request)
    {
        try {

            $zoneIds = [];
            $drivers = $this->model;
            if ($request->lat && $request->lng) {
                $zones = getZoneByPoint($request->lat, $request->lng);
                if (!$zones->isEmpty()) {
                    foreach ($zones as $zone) {
                        $zoneIds[] = $zone?->id;
                    }
                }
            }

            if ($request?->service_id) {
                $drivers = $drivers?->where('service_id', $request?->service_id);
            }

            if ($request?->service_category_id) {
                $drivers = $drivers?->where('service_category_id', $request?->service_category_id);
            }

            $driverIds = $drivers?->pluck('id')?->toArray();

            if ($request?->vehicle_type_id) {
                $vehicleTypeId = $request?->vehicle_type_id;
                $drivers = $drivers?->whereHas('vehicle_info', function (Builder $vehicleInfo) use ($vehicleTypeId) {
                    $vehicleInfo->where('vehicle_type_id', $vehicleTypeId);
                });
            }

            return Ambulance::whereNull('deleted_at')?->whereIn('driver_id', $driverIds)?->simplePaginate();

        } catch (Exception $e) {

            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function findDriver($request)
    {
        try {
            if (getServiceIdBySlug(ServicesEnum::FINDDRIVER) != $request->service_id) {
                throw new Exception('Invalid service for find driver.', 422);
            }

            $serviceCategoryType = getServiceCategoryTyeById($request->service_category_id);
            if (!in_array($serviceCategoryType, [
                ServiceCategoryEnum::ONEWAY,
                ServiceCategoryEnum::ROUNDTRIP,
                ServiceCategoryEnum::OUTSTATION,
                ServiceCategoryEnum::DAILY
            ])) {
                throw new Exception('invalid service category for find driver.', 422);
            }


            $drivers = $this->model->whereNull('deleted_at')
                ->where('status', true);

            if ($request?->service_id) {
                $drivers = $drivers?->where('service_id', $request?->service_id);
            }

            if ($request?->vehicle_type_id) {
                $drivers = $drivers?->where('vehicle_type_id', $request?->vehicle_type_id);
            }

            if ($request?->gear_type) {
                $drivers = $drivers?->where('gear_type', $request?->gear_type);
            }

            $driverIds = $drivers?->pluck('id')?->toArray() ?? [];
            $coordinate = head($request->location_coordinates);

            if (count($driverIds) > 0) {
                $driverIds = $this->findNearestDrivers($coordinate['lat'], $coordinate['lng'], $driverIds);
            }




            $driverList = $this->model->whereIn('id', $driverIds)?->get();

            $serviceCategoryType = getServiceCategoryTyeById($request->service_category_id);
            $targetCategories = [
                ServiceCategoryEnum::ONEWAY,
                ServiceCategoryEnum::ROUNDTRIP,
                ServiceCategoryEnum::OUTSTATION,
                ServiceCategoryEnum::DAILY,
            ];

            if (count($request->location_coordinates ?? []) > 1 && in_array($serviceCategoryType, $targetCategories)) {
                $zoneRideDistance = $this->getZoneRideDistance($request->location_coordinates);
                if ($zoneRideDistance) {
                    $distance = (float) $zoneRideDistance->ride_distance['distance_value'] ?? 0;

                    $durationText = $zoneRideDistance->ride_distance['duration'] ?? '0 mins';
                    $distanceUnit = $zoneRideDistance->ride_distance['distance_unit'] ?? 'Km';
                    preg_match('/(\d+)/', $durationText, $matches);
                    $durationMinutes = $matches[1] ?? 0;
                    $currencySymbol = $zoneRideDistance->zone->currency->symbol ?? '';

                    foreach ($driverList as $driver) {
                        $fare = 0;
                        $priceTypes = $driver->price_type ?? [];

                        if (is_string($priceTypes)) {
                            $priceTypes = json_decode($priceTypes, true);
                        }

                        if (!is_array($priceTypes)) {
                            $priceTypes = [];
                        }

                        $perKm = (float) ($driver->per_km_charge ?? 0);
                        $perHour = (float) ($driver->per_hour_charge ?? 0);
                        $perDay = (float) ($driver->per_day_charge ?? 0);

                        if (in_array('per_km_charge', $priceTypes)) {
                            $fare += $distance * $perKm;
                        }

                        if (in_array('per_hour_charge', $priceTypes)) {
                            $fare += ($durationMinutes / 60) * $perHour;
                        }

                        if ($serviceCategoryType == ServiceCategoryEnum::DAILY) {
                            if (in_array('per_day_charge', $priceTypes)) {
                                $days = 1;
                                $startTime = $request->start_time;
                                if ($request->start_date && $request->start_time) {
                                    $startTime = $request->start_date . ' ' . $request->start_time;
                                }
                                if ($startTime && $request->end_time) {
                                    $start = Carbon::parse($startTime);
                                    $end = Carbon::parse($request->end_time);
                                    $hours = $start->diffInHours($end);
                                    $days = $hours > 0 ? ceil($hours / 24) : 1;
                                }

                                $fare += $days * $perDay;
                            }
                        }

                        if ($serviceCategoryType == ServiceCategoryEnum::ROUNDTRIP || ($request?->outstation_type == 'round_trip' && $serviceCategoryType == ServiceCategoryEnum::OUTSTATION)) {
                            $fare = $fare * 2;
                        }

                        $vehicleTypeZone = VehicleTypeZone::where('vehicle_type_id', $driver->vehicle_type_id)
                            ->where('zone_id', $zoneRideDistance->zone?->id)
                            ->first();

                        $tax = 0;
                        $commission = 0;

                        if ($vehicleTypeZone) {
                            if ($vehicleTypeZone->commission_type == 'percentage') {
                                $commission = ($fare * $vehicleTypeZone->commission_rate) / 100;
                            } else {
                                $commission = $vehicleTypeZone->commission_rate;
                            }

                            if ($vehicleTypeZone->is_allow_tax && $vehicleTypeZone->tax) {
                                $tax = ($fare * $vehicleTypeZone->tax->rate) / 100;
                            }
                        }

                        $driver->driver_charge = round($fare, 2);
                        $driver->admin_commission = round($commission, 2);
                        $driver->tax = round($tax, 2);
                        $driver->total = round($fare + $commission + $tax, 2);
                        $driver->ride_fare = round($fare, 2);
                        $driver->distance = $distance;
                        $driver->distance_unit = $distanceUnit;
                        $driver->duration = $durationText;
                        $driver->currency_symbol = $currencySymbol;
                    }
                }
            }

            return $driverList;

        } catch (Exception $e) {

            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function fleetDriverRegister($request)
    {
        DB::beginTransaction();
        try {

            $roleName = getCurrentRoleName();
            if ($roleName != RoleEnum::FLEET_MANAGER) {
                throw new Exception('Only fleet manager can create a driver.', 403);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
                'country_code' => 'required',
                'phone' => 'required|min:6|max:15',
                'vehicle_info_id' => 'required|exists:vehicle_info,id,deleted_at,NULL',
                'documents' => 'array|required',
                'documents.*.slug' => 'exists:documents,slug,deleted_at,NULL|required',
                'service_id' => 'required|exists:services,id,deleted_at,NULL',
                'service_category_id' => 'nullable|exists:service_categories,id,deleted_at,NULL',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first(), 422);
            }

            $taxidoSettings = getTaxidoSettings();
            $driverIsVerified = 0;
            if (!$taxidoSettings['activation']['driver_verification']) {
                $driverIsVerified = 1;
            }

            $driver = $this->model->create([
                'name' => $request->name,
                'email' => $request->email,
                'country_code' => $request->country_code,
                'phone' => (string) $request->phone,
                'service_id' => $request->service_id,
                'service_category_id' => $request->service_category_id,
                'fleet_manager_id' => getCurrentUserId(),
                'password' => Hash::make($request->password),
                'is_verified' => $driverIsVerified,
            ]);

            $driver->assignRole(RoleEnum::DRIVER);
            $driver->wallet()->create();
            $driver->wallet;

            if ($request->vehicle_info_id) {
                $vehicleInfo = VehicleInfo::where('id', $request->vehicle_info_id)?->where('fleet_manager_id', getCurrentUserId())?->first();
                if (!$vehicleInfo) {
                    throw new Exception('Selected vehicle is invalid for current fleet manager.', 422);
                }

                $vehicleInfo->update([
                    'driver_id' => $driver?->id,
                ]);
            }

            if (!empty($request->documents) && is_array($request->documents)) {
                if (count($request->documents)) {
                    foreach ($request->documents as $document) {
                        if (is_array($document)) {
                            $attachmentObj = createAttachment();
                            $attachment_id = addMedia($attachmentObj, $document['file'])?->id;
                            $attachmentObj?->delete();
                            $doc = Document::where('slug', $document['slug'])->first();
                            $expired_at = $document['expired_at'] ?? null;
                            if ($doc?->need_expired_date) {
                                if (!$expired_at) {
                                    throw new Exception(__('taxido::auth.expired_date_required', ['name' => $doc?->name]), 422);
                                }
                            }

                            $driver->documents()?->create([
                                'document_id' => $doc?->id,
                                'document_image_id' => $attachment_id,
                                'expired_at' => $expired_at,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            $driver = $driver->refresh();
            return new DriverResource($driver);

        } catch (Exception $e) {

            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function fleetDriverUpdate($request)
    {
        DB::beginTransaction();
        try {

            $roleName = getCurrentRoleName();
            if ($roleName != RoleEnum::FLEET_MANAGER) {
                throw new Exception('Only fleet manager can update a driver.', 403);
            }

            $validator = Validator::make($request->all(), [
                'driver_id' => 'required|exists:users,id,deleted_at,NULL',
                'name' => 'sometimes|required|string',
                'email' => 'sometimes|nullable|string|email|max:255|unique:users,email,' . ($request->driver_id ?? 'NULL') . ',id,deleted_at,NULL',
                'country_code' => 'sometimes|required',
                'phone' => 'sometimes|required|min:6|max:15',
                'vehicle_info_id' => 'sometimes|nullable|exists:vehicle_info,id,deleted_at,NULL',
                'documents.*.slug' => 'sometimes|exists:documents,slug,deleted_at,NULL',
                'service_id' => 'sometimes|exists:services,id,deleted_at,NULL',
                'service_category_id' => 'sometimes|nullable|exists:service_categories,id,deleted_at,NULL',
                'profile_image_id' => 'sometimes|nullable|exists:attachments,id,deleted_at,NULL',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first(), 422);
            }

            $driver = $this->model->findOrFail($request->driver_id);
            if ($driver->fleet_manager_id != getCurrentUserId()) {
                throw new Exception('You can only update your own drivers.', 403);
            }

            $driver->update($request->all());
            if ($request->vehicle_info_id) {
                $vehicleInfo = VehicleInfo::where('id', $request->vehicle_info_id)?->where('fleet_manager_id', getCurrentUserId())?->first();
                if (!$vehicleInfo) {
                    throw new Exception('Selected vehicle is invalid for current fleet manager.', 422);
                }

                $vehicleInfo->update([
                    'driver_id' => $driver?->id,
                ]);
            }

            if (!empty($request->documents) && is_array($request->documents)) {
                foreach ($request->documents as $document) {
                    if (is_array($document)) {
                        $doc = Document::where('slug', $document['slug'])->first();
                        if ($doc) {
                            $attachmentId = null;
                            if (!empty($document['file'])) {
                                $attachmentObj = createAttachment();
                                $attachmentId = addMedia($attachmentObj, $document['file'])?->id;
                                $attachmentObj?->delete();
                            }
                            $expired_at = $document['expired_at'] ?? null;
                            if ($doc?->need_expired_date && !$expired_at) {
                                throw new Exception(__('taxido::auth.expired_date_required', ['name' => $doc?->name]), 422);
                            }

                            $payload = [
                                'expired_at' => $expired_at,
                            ];

                            if ($attachmentId) {
                                $payload['document_image_id'] = $attachmentId;
                            }

                            $driver->documents()?->updateOrCreate([
                                'document_id' => $doc?->id,
                            ], $payload);
                        }
                    }
                }
            }

            DB::commit();
            $driver = $driver->fresh();
            return new DriverResource($driver);

        } catch (Exception $e) {

            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function fleetDriverDelete($driverId)
    {
        DB::beginTransaction();
        try {

            $roleName = getCurrentRoleName();
            if ($roleName != RoleEnum::FLEET_MANAGER) {
                throw new Exception('Only fleet manager can delete a driver.', 403);
            }

            $driver = $this->model->findOrFail($driverId);
            if ($driver->fleet_manager_id != getCurrentUserId()) {
                throw new Exception('You can only delete your own drivers.', 403);
            }

            $driver->delete();
            DB::commit();

            return [
                'success' => true,
            ];

        } catch (Exception $e) {

            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }
}
