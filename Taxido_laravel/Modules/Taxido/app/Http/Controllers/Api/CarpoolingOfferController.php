<?php

namespace Modules\Taxido\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ExceptionHandler;
use Modules\Taxido\Http\Requests\Api\CreateCarpoolingOfferRequest;
use Modules\Taxido\Http\Resources\CarpoolingOfferResource;
use Modules\Taxido\Models\CarpoolingOffer;
use Modules\Taxido\Models\RideRequest;

class CarpoolingOfferController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $driver = getCurrentDriver();
            $offers = CarpoolingOffer::where('driver_id', $driver->id)
                ->with(['vehicleType'])
                ->orderBy('created_at', 'desc')
                ->simplePaginate($request->per_page ?? 15);

            return response()->json([
                'success' => true,
                'data' => CarpoolingOfferResource::collection($offers),
                'meta' => [
                    'current_page' => $offers->currentPage(),
                    'last_page' => $offers->lastPage(),
                    'per_page' => $offers->perPage(),
                    'total' => $offers->total(),
                ],
            ]);
        } catch (Exception $e) {
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function store(CreateCarpoolingOfferRequest $request): JsonResponse
    {
        try {
            $driver = getCurrentDriver();
            $validated = $request->validated();

            $validated['available_seats'] = $validated['available_seats'] ?? $validated['total_seats'];

            DB::beginTransaction();

            $offer = CarpoolingOffer::create([
                'driver_id' => $driver->id,
                'vehicle_type_id' => $validated['vehicle_type_id'] ?? null,
                'total_seats' => $validated['total_seats'],
                'available_seats' => $validated['available_seats'],
                'discount' => $validated['discount'] ?? null,
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'pickup_location' => $validated['pickup_location'] ?? null,
                'pickup_lat' => $validated['pickup_lat'] ?? null,
                'pickup_lng' => $validated['pickup_lng'] ?? null,
                'dropoff_location' => $validated['dropoff_location'] ?? null,
                'dropoff_lat' => $validated['dropoff_lat'] ?? null,
                'dropoff_lng' => $validated['dropoff_lng'] ?? null,
                'available_area' => $validated['available_area'] ?? null,
                'km_range' => $validated['km_range'] ?? 1,
                'is_active' => $validated['is_active'] ?? true,
                'preferences' => $validated['preferences'] ?? null,
            ]);

            DB::commit();

            $offer->load(['vehicleType']);

            return response()->json([
                'success' => true,
                'message' => __('taxido::static.success'),
                'data' => new CarpoolingOfferResource($offer),
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function show(CarpoolingOffer $offer): JsonResponse
    {
        try {
            $offer->load(['driver', 'driver.profile_image', 'vehicleType', 'vehicleType.vehicle_map_icon']);

            return response()->json([
                'success' => true,
                'data' => new CarpoolingOfferResource($offer),
            ]);
        } catch (Exception $e) {
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function update(CreateCarpoolingOfferRequest $request, CarpoolingOffer $offer): JsonResponse
    {
        try {
            $driver = getCurrentDriver();

            if ($offer->driver_id !== $driver->id) {
                throw new Exception('Unauthorized', 403);
            }

            $validated = $request->validated();

            DB::beginTransaction();

            $offer->update($validated);

            DB::commit();

            $offer->load(['vehicleType']);

            return response()->json([
                'success' => true,
                'message' => __('taxido::static.success'),
                'data' => new CarpoolingOfferResource($offer),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function destroy(CarpoolingOffer $offer): JsonResponse
    {
        try {
            $driver = getCurrentDriver();

            if ($offer->driver_id !== $driver->id) {
                throw new Exception('Unauthorized', 403);
            }

            $offer->delete();

            return response()->json([
                'success' => true,
                'message' => __('taxido::static.success'),
            ]);
        } catch (Exception $e) {
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function search(Request $request): JsonResponse
    {
        try {
            $query = CarpoolingOffer::where('is_active', true)
                ->with(['driver', 'driver.profile_image', 'vehicleType', 'vehicleType.vehicle_map_icon']);

            $pickupLat = $request->input('pickup_lat');
            $pickupLng = $request->input('pickup_lng');
            $radiusKm = $request->input('radius', 50);

            if ($pickupLat && $pickupLng) {
                $lat = (float) $pickupLat;
                $lng = (float) $pickupLng;
                $radius = (float) $radiusKm;

                $query->whereNotNull('pickup_lat')
                    ->whereNotNull('pickup_lng')
                    ->selectRaw("
                        *,
                        (6371 * acos(
                            cos(radians(?)) * cos(radians(pickup_lat)) *
                            cos(radians(pickup_lng) - radians(?)) +
                            sin(radians(?)) * sin(radians(pickup_lat))
                        )) AS distance
                    ", [$lat, $lng, $lat])
                    ->having('distance', '<=', $radius)
                    ->orderBy('distance', 'asc');
            }

            if ($request->has('dropoff_lat') && $request->has('dropoff_lng')) {
                $query->whereNotNull('dropoff_lat')
                    ->whereNotNull('dropoff_lng');
            }

            if ($request->has('vehicle_type_id')) {
                $query->where('vehicle_type_id', $request->vehicle_type_id);
            }

            if ($request->has('min_seats')) {
                $query->where('available_seats', '>=', $request->min_seats);
            }

            if ($request->has('date')) {
                $query->where('start_date', '<=', $request->date)
                    ->where('end_date', '>=', $request->date);
            }

            if ($request->has('available_area')) {
                $query->where('available_area', 'like', '%' . $request->available_area . '%');
            }

            $offers = $query->orderBy('created_at', 'desc')
                ->simplePaginate($request->per_page ?? 15);

            return response()->json([
                'success' => true,
                'data' => CarpoolingOfferResource::collection($offers),
                'meta' => [
                    'current_page' => $offers->currentPage(),
                    'last_page' => $offers->lastPage(),
                    'per_page' => $offers->perPage(),
                    'total' => $offers->total(),
                ],
            ]);
        } catch (Exception $e) {
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function book(Request $request, CarpoolingOffer $offer): JsonResponse
    {
        try {
            $rider = getCurrentRider();
            $seatsToBook = $request->input('seats', 1);

            if ($offer->available_seats < $seatsToBook) {
                throw new Exception('Not enough seats available', 422);
            }

            DB::beginTransaction();

            $offer->decrement('available_seats', $seatsToBook);

            $rideRequest = RideRequest::create([
                'ride_number' => 100000 + ((RideRequest::max('id') + 1) + \Modules\Taxido\Models\Ride::max('id') + 1),
                'rider_id' => $rider->id,
                'payment_method' => $request->input('payment_method', 'cash'),
                'vehicle_type_id' => $offer->vehicle_type_id,
                'service_id' => 1,
                'service_category_id' => 1,
                'rider' => $rider,
                'total_seats' => $seatsToBook,
                'booked_seats' => $seatsToBook,
                'available_seats' => 0,
                'locations' => $offer->pickup_location,
                'location_coordinates' => [
                    ['lat' => $offer->pickup_lat, 'lng' => $offer->pickup_lng],
                    ['lat' => $offer->dropoff_lat, 'lng' => $offer->dropoff_lng],
                ],
                'driver_id' => $offer->driver_id,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Seat booked successfully',
                'data' => [
                    'offer_id' => $offer->id,
                    'ride_request_id' => $rideRequest->id,
                    'seats_booked' => $seatsToBook,
                    'remaining_seats' => $offer->fresh()->available_seats,
                ],
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }
}
