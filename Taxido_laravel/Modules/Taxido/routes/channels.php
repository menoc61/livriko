<?php

use Modules\Taxido\Models\Bid;
use Modules\Taxido\Models\Ride;
use Modules\Taxido\Models\Driver;
use Illuminate\Support\Facades\DB;
use Modules\Taxido\Models\RideRequest;
use Illuminate\Support\Facades\Broadcast;
use Modules\Taxido\Enums\RoleEnum;
use Modules\Taxido\Services\DriverStateService;
use Modules\Taxido\Services\PeakZoneStateService;


Broadcast::channel('document-verification.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
}, ['guards' => ['sanctum']]);

Broadcast::channel('driver-ride-request-{driverId}', function ($user, $driverId) {
    return (int) $user->id === (int) $driverId;
}, ['guards' => ['sanctum']]);


Broadcast::channel('bid-status.{bidId}', function ($user, $bidId) {
    $bid = Bid::where('id', $bidId)?->first();
    if ($bid) {
        return (int) $user->id === (int) $bid->driver_id;
    }
    return false;
}, ['guards' => ['sanctum']]);


Broadcast::channel('driver-notification.{driverId}', function ($user, $driverId) {
    $driver = Driver::find($driverId);
    if (!$driver) {
        return false;
    }

    $location = $driver->location[0] ?? null;

    return [
        'id' => $user->id,
        'name' => $user->name,
        'driver_id' => (int) $driverId,
        'lat' => (float) ($location['lat'] ?? 0),
        'lng' => (float) ($location['lng'] ?? 0),
        'bearing' => (float) ($location['bearing'] ?? 0),
        'is_online' => (bool) $driver->is_online,
        'is_on_ride' => (bool) $driver->is_on_ride,
        'is_verified' => (bool) $driver->is_verified,
        'updated_at' => now()->toIso8601String(),
    ];
}, ['guards' => ['sanctum']]);


Broadcast::channel('rider.{riderId}', function ($user, $riderId) {
    return (int) $user->id === (int) $riderId;
}, ['guards' => ['sanctum']]);

Broadcast::channel('ride-request.{rideRequestId}', function ($user, $rideRequestId) {
    $rideRequest = RideRequest::find($rideRequestId);
    if (!$rideRequest) return false;
    if (method_exists($user, 'hasRole') && $user->hasRole('admin')) return true;
    if ((int) $user->id === (int) $rideRequest->rider_id) return true;
    $isDriver = Driver::where('id', $user->id)->exists();
    if ($isDriver) {
        return DB::table('ride_request_drivers')
            ->where('ride_request_id', $rideRequestId)
            ->where('driver_id', $user->id)
            ->exists();
    }

    return false;
}, ['guards' => ['web', 'sanctum']]);

Broadcast::channel('ride-request-status.{rideRequestId}', function ($user, $rideRequestId) {
    if (method_exists($user, 'hasRole') && $user->hasRole('admin')) return true;
    $rideRequest = RideRequest::find($rideRequestId);
    if (!$rideRequest) return false;
    return (int) $user->id === (int) $rideRequest->rider_id;
}, ['guards' => ['web', 'sanctum']]);

Broadcast::channel('ride-status.{rideId}', function ($user, $rideId) {
    if (method_exists($user, 'hasRole') && $user->hasRole('admin')) return true;
    $ride = Ride::find($rideId);
    if (!$ride) return false;
    return (int) $user->id === (int) $ride->rider_id
        || (int) $user->id === (int) $ride->driver_id;
}, ['guards' => ['web', 'sanctum']]);

Broadcast::channel('fleet.{fleetManagerId}', function ($user, $fleetManagerId) {
    if ((int) $user->id === (int) $fleetManagerId && $user->hasRole(RoleEnum::FLEET_MANAGER)) {
        return app(DriverStateService::class)->getFleetDriversData((int) $fleetManagerId);
    }
    return false;
}, ['guards' => ['web', 'sanctum']]);


Broadcast::channel('peak-zone-{zoneId}', function ($user, $zoneId) {
    if ($user) {
        return app(PeakZoneStateService::class)->getActiveByZone((int) $zoneId) ?: true;
    }
    return false;
}, ['guards' => ['sanctum']]);
