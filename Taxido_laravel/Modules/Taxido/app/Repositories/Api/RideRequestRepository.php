<?php

namespace Modules\Taxido\Repositories\Api;

use Exception;
use App\Enums\RoleEnum;
use Modules\Taxido\Models\Ride;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Models\Ambulance;
use App\Exceptions\ExceptionHandler;
use Modules\Taxido\Models\RideRequest;
use Modules\Taxido\Enums\RideStatusEnum;
use Modules\Taxido\Models\RentalVehicle;
use Modules\Taxido\Events\RideRequestEvent;
use Modules\Taxido\Jobs\AssignNextDriverJob;
use Prettus\Repository\Eloquent\BaseRepository;
use Modules\Taxido\Enums\RoleEnum as EnumsRoleEnum;
use Modules\Taxido\Http\Resources\RideDetailResource;
use Modules\Taxido\Http\Traits\RideRequestTrait;
use Modules\Taxido\Broadcasts\DriverRideRequestBroadcast;
use Modules\Taxido\Http\Resources\Drivers\RideRequestResource;

class RideRequestRepository extends BaseRepository
{
    use RideRequestTrait;

    public function model()
    {
        return RideRequest::class;
    }

    public function store($request)
    {
        try {

            $request->merge(['current_time' => $request?->current_time ?? now(env('APP_TIMEZONE'))?->format('H:i:s')]);
            return $this->createCabRideRequest($request);

        } catch (Exception $e) {

            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {

            $roleName = getCurrentRoleName();
            $rideRequest = $this->model->findOrFail($id);
            if ($roleName != RoleEnum::ADMIN && $roleName != EnumsRoleEnum::DRIVER) {
                if ($rideRequest?->created_by_id != getCurrentUserId()) {
                    throw new Exception(__('taxido::static.rides.update_permission'), 400);
                }
            }

            if (isset($request['drivers'])) {
                $rideRequest->drivers()->sync($request['drivers']);
            }

            $shouldCancel = isset($request['status']) && $request['status'] == RideStatusEnum::CANCELLED;
            if ($shouldCancel) {
                $rideRequest->ride_status_activities()->create([
                    'status' => $request['status'],
                    'changed_at' => now(),
                ]);
            }

            DB::commit();
            if (function_exists('fastcgi_finish_request')) {
                fastcgi_finish_request();
            }

            return response()->json(['id' => $rideRequest->id]);

        } catch (Exception $e) {
            DB::rollBack();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {

            $this->model->findOrFail($id)->delete();
            return response()->json(['success' => true]);

        } catch (Exception $e) {
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function accept($request)
    {
        try {
            $driver = getCurrentDriver();
            if (!$driver) {
                throw new Exception(__('taxido::static.rides.only_driver_can_accept_ride_request_directly'), 400);
            }

            $ride = $this->createRide($request);
            $rideRequest = RideRequest::findOrFail($request->ride_request_id);
            if ($rideRequest) {
                $rideRequest->update([
                    'current_driver_id'            => null,
                    'driver_acceptance_expires_at' => null,
                ]);
            }

            return new RideDetailResource($ride);

        } catch (Exception $e) {
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function reject($request)
    {
        DB::beginTransaction();
        try {
            $driver          = getCurrentDriver();
            $ride_request_id = $request->ride_request_id;

            if (!$driver || !$ride_request_id) {
                throw new Exception(__('taxido::static.rides.invalid_request'), 400);
            }

            $rideRequest = RideRequest::findOrFail($ride_request_id);
            $rejected   = $rideRequest->rejected_driver_ids ?? [];
            $rejected[] = $driver->id;

            $rideRequest->update([
                'rejected_driver_ids'          => array_values(array_unique($rejected)),
                'current_driver_id'            => null,
                'driver_acceptance_expires_at' => null,
            ]);
            $rideRequest->ride_status_activities()->create([
                'status'     => RideStatusEnum::REJECTED,
                'changed_at' => now(),
            ]);

            DB::commit();

            try {
                event(new DriverRideRequestBroadcast($rideRequest, $driver->id, 'rejected'));
            } catch (Exception $broadcastEx) {
                Log::warning('RideRequestRepository@reject: Reverb broadcast failed: ' . $broadcastEx->getMessage());
            }

            AssignNextDriverJob::dispatch($ride_request_id);
            return response()->json([
                'message'         => __('taxido::static.rides.ride_rejected_successfully'),
                'ride_request_id' => $ride_request_id,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function rental($request)
    {
        DB::beginTransaction();
        try {
            if ($this->verifyVehicleType($request)) {
                $rider_id = $request->rider_id ?? getCurrentUserId();
                if ($this->verifyRideWalletBalance($rider_id)) {
                    $formattedLocations = $request->locations;
                    $no_of_days = $this->getNoOfDaysAttribute($request->start_time, $request->end_time);
                    $request->no_of_days = $no_of_days;
                    $rentalVehicle = RentalVehicle::findOrFail($request->rental_vehicle_id);
                    $symbol = $rentalVehicle?->zone?->currency?->symbol ?? getDefaultCurrencySymbol();
                    $charges = $this->calRentalVehicleCharges($request, $rentalVehicle);
                    $rideRequest = $this->model->create([
                        'rider_id' => $rider_id,
                        'ride_number' => 100000 + ((RideRequest::max('id') + 1) + Ride::max('id') + 1),
                        'payment_method' => $request->payment_method,
                        'vehicle_type_id' => $request->vehicle_type_id,
                        'service_id' => $request->service_id,
                        'service_category_id' => $request->service_category_id,
                        'rider' => $request->new_rider ?? getCurrentRider(),
                        'description' => $request->description,
                        'locations' => $formattedLocations,
                        'location_coordinates' => $request->location_coordinates,
                        'is_with_driver' => $request?->is_with_driver,
                        'start_time' => $request->start_time,
                        'end_time' => $request->end_time,
                        'currency_symbol' => $symbol,
                        'rental_vehicle_id' => $request->rental_vehicle_id,
                        'no_of_days' => $no_of_days,
                        'driver_per_day_charge' => $charges['driver_per_day_charge'] ?? 0,
                        'vehicle_per_day_charge' => $charges['vehicle_per_day_charge'] ?? 0,
                        'driver_rent' => $charges['driver_rent'] ?? 0,
                        'vehicle_rent' => $charges['vehicle_rent'] ?? 0,
                        'platform_fee' => $charges['platform_fee'] ?? 0,
                        'tax' => $charges['tax'] ?? 0,
                        'total' => $charges['total'] ?? 0,
                        'sub_total' => $charges['sub_total'] ?? 0,
                        'commission' => $charges['commission'] ?? 0,
                        'driver_commission' => $charges['driver_commission'] ?? 0,
                    ]);

                    $coordinate = head($request->location_coordinates);
                    $zones = getZoneByPoint($coordinate['lat'], $coordinate['lng'])?->pluck('id')?->toArray();
                    $rideRequest?->zones()?->attach($zones);

                    $driver_id = $rideRequest?->rental_vehicle?->driver_id;
                    $rideRequest?->drivers()?->attach([$driver_id]);

                    DB::commit();
                    event(new RideRequestEvent($rideRequest));

                    $rideRequest?->ride_status_activities()?->create([
                        'status' => RideStatusEnum::REQUESTED,
                        'changed_at' => now(),
                    ]);

                    if ($driver_id) {
                        event(new DriverRideRequestBroadcast($rideRequest, (int) $driver_id, 'request'));
                    }

                    return response()->json(['id' => $rideRequest->id, 'data' => new RideRequestResource($rideRequest), 'drivers' => $driver_id]);
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function ambulance($request)
    {
        try {
            DB::beginTransaction();
            $rider_id = $request->rider_id ?? getCurrentUserId();
            $ambulance = Ambulance::with('driver')->find($request->ambulance_id);
            if (!$ambulance || !$ambulance->driver || !$ambulance->driver->is_online) {
                throw new Exception(__('taxido::static.rides.ambulance_not_found'), 400);
            }
            $driverLocation = $ambulance->driver->location;
            $lat = $driverLocation[0]['lat'] ?? null;
            $lng = $driverLocation[0]['lng'] ?? null;

            if (!$lat || !$lng) {
                throw new Exception(__('taxido::static.rides.ambulance_location_not_found'), 400);
            }

            $ride_locations = array_merge($request->location_coordinates, [
                [
                    'lat' => $lat,
                    'lng' => $lng
                ]
            ]);

            $zoneRideDistance = $this->getZoneRideDistance($ride_locations);
            $resDistance = $zoneRideDistance?->ride_distance;
            $settings = getTaxidoSettings();
            $perKm = $settings['driver_commission']['ambulance_per_km_charge'] ?? 1;
            $perMin = $settings['driver_commission']['ambulance_per_minute_charge'] ?? 0;
            $duration = (int) filter_var($resDistance['duration'] ?? '0', FILTER_SANITIZE_NUMBER_INT);
            $additional_min_charge = $duration * $perMin;
            $baseFee = $settings['driver_commission']['ambulance_base_fair_charge'] ?? 0;
            $totalDistance = ($resDistance['distance_value'] ?? 0);
            if($totalDistance) {
                $totalDistance -= 1;
            }

            $rideFare = (($totalDistance ?? 0) * $perKm) + $baseFee;
            $subTotal = $rideFare + $additional_min_charge;
            $commissionRate = $settings['driver_commission']['ambulance_commission_rate'] ?? 0;
            $commission = ($subTotal * $commissionRate) / 100;
            $platform_fee = (float) getPlatformFee();
            $total = $subTotal + $commission + $platform_fee;
            $symbol = $zoneRideDistance?->zone?->currency?->symbol;

            $rideRequest = $this->model->create([
                'ride_number' => 100000 + ((RideRequest::max('id') + 1) + Ride::max('id') + 1),
                'rider_id' => $rider_id,
                'ambulance_id' => $request->ambulance_id,
                'service_id' => $request->service_id,
                'rider' => $request->new_rider ?? getCurrentRider(),
                'ride_fare' => $rideFare,
                'additional_minute_charge' => $additional_min_charge,
                'duration' => $resDistance['duration'] ?? '0',
                'description' => $request->description,
                'locations' => $request->locations,
                'location_coordinates' => $ride_locations,
                'currency_symbol' => $symbol,
                'distance' => $resDistance['distance_value'] ?? 0,
                'distance_unit' => $resDistance['distance_unit'] ?? null,
                'platform_fee' => $platform_fee,
                'sub_total' => $subTotal,
                'total' => $total,
                'commission' => $commission,
                'driver_commission' => $subTotal - $commission,
            ]);

            $coordinate = head($request->location_coordinates);
            $zones = getZoneByPoint($coordinate['lat'], $coordinate['lng'])?->pluck('id')?->toArray();
            $rideRequest?->zones()?->attach($zones);
            $rideRequest?->drivers()?->attach([$ambulance->driver_id]);
            $rideRequest?->ride_status_activities()?->create([
                'status' => RideStatusEnum::REQUESTED,
                'changed_at' => now(),
            ]);

            DB::commit();
            $rideRequest = $rideRequest->refresh();
            dispatch(fn() => event(new RideRequestEvent($rideRequest)))->afterResponse();

            if ($ambulance->driver_id) {
                event(new DriverRideRequestBroadcast($rideRequest, (int) $ambulance->driver_id, 'request'));
            }

            return response()->json(['id' => $rideRequest->id, 'data' => new RideRequestResource($rideRequest), 'drivers' => $ambulance->driver_id]);
        } catch (Exception $e) {
            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }
}
