<?php

namespace Modules\Taxido\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Traits\RealtimeTrait;
use Modules\Taxido\Models\Driver;
use Modules\Taxido\Http\Traits\RideTrait;
use Modules\Taxido\Tables\RideRequestTable;
use Modules\Taxido\Http\Requests\Admin\CreateRideRequest;
use Modules\Taxido\Repositories\Admin\RideRequestRepository;

class RideRequestController extends Controller
{
    use RideTrait;

    private $repository;

    public function __construct(RideRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RideRequestTable $rideRequestTable)
    {
        return $this->repository->index($rideRequestTable->generate());
    }

    public function create()
    {
        return view('taxido::admin.ride.create');
    }

    public function store(CreateRideRequest $request)
    {
        return $this->repository->store($request);
    }

    public function details(Request $request)
    {
        return $this->repository->details($request->id);
    }

    public function showHeatMap()
    {
       return $this->repository->showHeatMap();
    }

    public function fetchDrivers($lat, $lng, $serviceId = null, $serviceCategoryId = null, $vehicleTypeId = null)
    {
        $driverIds = $this->findNearestDrivers($lat, $lng);

        if (empty($driverIds)) {
            return response()->json([]);
        }

        $query = Driver::whereIn('id', $driverIds)
            ->with(['profile_image', 'vehicle_info.vehicle.vehicle_map_icon']);

        if ($serviceId) {
            $query->where('service_id', (int) $serviceId);
        }
        if ($serviceCategoryId) {
            $query->where('service_category_id', (int) $serviceCategoryId);
        }
        if ($vehicleTypeId) {
           $query->whereHas('vehicle_info', function (Builder $vehicleInfo) use ($vehicleTypeId) {
                $vehicleInfo->where('vehicle_type_id', $vehicleTypeId);
            });
        }

        $drivers = $query->get();
        $filteredDrivers = $drivers->map(function ($driver) {
            $location = $driver->location;
            $driverLat = $location[0]['lat'] ?? 0;
            $driverLng = $location[0]['lng'] ?? 0;

            return [
                'id' => $driver->id,
                'name' => $driver->name,
                'phone' => $driver->phone,
                'profile_image_url' => $driver->profile_image?->original_url ?? 'https://avatar.iran.liara.run/public/39',
                'vehicle_type_id' => $driver->vehicle_type_id,
                'rating' => $driver->rating_count,
                'vehicle_model' => $driver->vehicle_info?->model ?? 'N/A',
                'plate_number' => $driver->vehicle_info?->plate_number ?? 'N/A',
                'lat' => $driverLat,
                'lng' => $driverLng,
                'vehicle_map_icon_url' => $driver->vehicle_info?->vehicle?->vehicle_map_icon?->original_url ?? 'https://avatar.iran.liara.run/public/39',
            ];
        });

        return response()->json($filteredDrivers);
    }


}
