<?php

namespace Modules\Taxido\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Taxido\Models\Driver;
use App\Http\Controllers\Controller;
use Modules\Taxido\Tables\DriverTable;
use Modules\Taxido\Repositories\Admin\DriverRepository;
use Modules\Taxido\Http\Requests\Admin\CreateDriverRequest;
use Modules\Taxido\Http\Requests\Admin\UpdateDriverRequest;

class DriverController extends Controller
{
    private $repository;

    public function __construct(DriverRepository $repository)
    {
        $this->authorizeResource(Driver::class, 'driver');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(DriverTable $driverTable)
    {
        request()->merge(['is_verified' => true]);
        return $this->repository->index($driverTable->generate());
    }

    public function getUnverifiedDrivers(DriverTable $driverTable)
    {
        request()->merge(['is_verified' => false]);
        return $this->repository->getUnverifiedDrivers($driverTable->generate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taxido::admin.driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDriverRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Driver $driver)
    {
        $drivers = Driver::where('id', $driver->id)->get();
        $locations = $drivers->flatMap(function ($driver) {
            $locationData = $driver->location;
            return collect($locationData)->map(function ($loc) use ($driver) {
                $vehicleImage = $driver->vehicle_info->vehicle?->vehicle_map_icon?->original_url ?? asset('images/user.png');
                return [
                    'lat' => $loc['lat'],
                    'lng' => $loc['lng'],
                    'id' => $driver->id,
                    'image' => $driver->profile_image?->original_url,
                    'name' => $driver->name,
                    'phone' => $driver->phone,
                    'vehicle_name' => $driver->vehicle_info?->vehicle?->name,
                    'vehicle_model' => $driver->vehicle_info?->model,
                    'plate_number' => $driver->vehicle_info?->plate_number,
                    'vehicle_image' => $vehicleImage,
                ];
            });
        });

        return view('taxido::admin.driver.details', ['driver' => $driver , 'locations' => $locations,]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return view('taxido::admin.driver.edit', ['driver' => $driver]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        return $this->repository->update($request->all(), $driver->id);
    }

    /**
     * Update Status the specified resource from storage.
     *
     */
    public function status(Request $request, $id)
    {
        return $this->repository->status($id, $request->status);
    }

    public function driverLocation()
    {
        $initialDrivers = Driver::where('is_verified', 1)
            ->with([
                'profile_image',
                'vehicle_info.vehicle.vehicle_map_icon',
                'onRides' => function($query) {
                    $query->with([
                        'rider.profile_image',
                        'service',
                        'service_category',
                        'vehicle_type.vehicle_image',
                        'ride_status'
                    ]);
                }
            ])->get()->map(function($driver) {
                $data = [
                    'id' => $driver->id,
                    'driver_name' => $driver->name,
                    'phone' => $driver->phone,
                    'is_online' => $driver->is_online ? "1" : "0",
                    'is_on_ride' => $driver->is_on_ride ? "1" : "0",
                    'is_verified' => $driver->is_verified ? 1 : 0,
                    'status' => $driver->status ? "1" : "0",
                    'profile_image_url' => $driver->profile_image?->original_url,
                    'model' => $driver->vehicle_info?->model,
                    'vehicle_name' => $driver->vehicle_info?->vehicle?->name,
                    'vehicle_map_icon_url' => $driver->vehicle_info?->vehicle?->vehicle_map_icon?->original_url,
                    'vehicle_type_id' => $driver->vehicle_info?->vehicle?->id,
                    'zone_id' => $driver->zones->first()?->id,
                    'rating' => (float) $driver->reviews?->avg('rating'),
                    'rating_count' => (int) $driver->reviews?->count(),
                ];

                $location = $driver->location;
                if ($location && isset($location[0]['lat'])) {
                    $data['lat'] = $location[0]['lat'];
                    $data['lng'] = $location[0]['lng'];
                }

                if ($driver->is_on_ride) {
                    $activeRide = $driver->onRides->first();
                    if ($activeRide) {
                        $data['ride_number'] = $activeRide->ride_number;
                        $data['ride_id'] = $activeRide->id;
                        $data['rider_name'] = $activeRide->rider?->name;
                        $data['rider_email'] = $activeRide->rider?->email;
                        $data['rider_image'] = $activeRide->rider?->profile_image?->original_url;
                        $data['service_name'] = $activeRide->service?->name;
                        $data['service_category_name'] = $activeRide->service_category?->name;
                        $data['vehicle_image'] = $activeRide->vehicle_type?->vehicle_image?->original_url;
                        $data['payment_status'] = $activeRide->payment_status;
                        $data['payment_method'] = $activeRide->payment_method;
                        $data['distance'] = $activeRide->distance;
                        $data['distance_unit'] = $activeRide->distance_unit;
                        $data['ride_status'] = $activeRide->ride_status?->name;
                        $data['plate_number'] = $driver->vehicle_info?->plate_number;
                    }
                }
                return $data;
            });

        return view('taxido::admin.driver-location.index', compact('initialDrivers'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        return $this->repository->destroy($driver->id);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        return $this->repository->restore($id);
    }

    /**
     * Permanent delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id);
    }

    public function verify(Request $request, $id)
    {
        return $this->repository->verify($id, $request->status);
    }

    public function driverDocument($id)
    {
        return to_route('admin.driver-document.index', ['driver_id' => $id]);
    }

    public function export(Request $request)
    {
        return $this->repository->export($request);
    }

    public function import(Request $request)
    {
        return $this->repository->import($request);
    }

}
