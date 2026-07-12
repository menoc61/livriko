<?php

namespace Modules\Taxido\Services;

use Illuminate\Support\Facades\Redis;
use Modules\Taxido\Broadcasts\FleetDriversLocationBroadcast;
use Modules\Taxido\Models\Driver;


class DriverStateService
{
    private const KEY_ONLINE_DRIVERS = 'driver_locations';
    private const KEY_DRIVER_METADATA = 'driver_metadata:';
    private const KEY_FLEET_DRIVERS = 'fleet_drivers:';


    public function updateDriverLocation(int $driverId, float $lat, float $lng, array $metadata = []): void
    {
        Redis::geoadd(self::KEY_ONLINE_DRIVERS, $lng, $lat, (string) $driverId);
        Redis::set(self::KEY_DRIVER_METADATA . $driverId, json_encode($metadata));
        Redis::expire(self::KEY_DRIVER_METADATA . $driverId, 600);
        if (isset($metadata['fleet_manager_id']) && $metadata['fleet_manager_id'] > 0) {
            Redis::sadd(self::KEY_FLEET_DRIVERS . $metadata['fleet_manager_id'], (string) $driverId);
            Redis::expire(self::KEY_FLEET_DRIVERS . $metadata['fleet_manager_id'], 3600);
            $this->broadcastFleetUpdate((int) $metadata['fleet_manager_id']);
        }

    }

    /**
     * Get all drivers of a fleet with their latest metadata and location.
     */
    public function getFleetDriversData(int $fleetManagerId): array
    {
        $driverIds = Redis::smembers(self::KEY_FLEET_DRIVERS . $fleetManagerId);
        if (empty($driverIds)) {
            return Driver::where('fleet_manager_id', $fleetManagerId)
                ->where('status', true)
                ->with('vehicle_info')
                ->get()
                ->map(fn($d) => $this->formatDriverForFleet($d))
                ->toArray();
        }

        $fleetDrivers = [];
        foreach ($driverIds as $driverId) {
            $metadataStr = Redis::get(self::KEY_DRIVER_METADATA . $driverId);
            if (!$metadataStr) {
                $driver = Driver::with('vehicle_info')->find($driverId);
                if ($driver && $driver->is_online) {
                    $fleetDrivers[] = $this->formatDriverForFleet($driver);
                } else {
                    Redis::srem(self::KEY_FLEET_DRIVERS . $fleetManagerId, $driverId);
                }
                continue;
            }

            $metadata = json_decode($metadataStr, true);
            $pos = Redis::geopos(self::KEY_ONLINE_DRIVERS, $driverId);
            if ($pos && isset($pos[0])) {
                $metadata['lat'] = (float) $pos[0][1];
                $metadata['lng'] = (float) $pos[0][0];
            } else {
                $driver = Driver::find($driverId);
                $location = $driver->location[0] ?? null;
                $metadata['lat'] = (float) ($location['lat'] ?? 0);
                $metadata['lng'] = (float) ($location['lng'] ?? 0);
            }

            $fleetDrivers[] = $metadata;
        }

        return $fleetDrivers;
    }

    /**
     * Helper to format driver model for fleet broadcasting.
     */
    private function formatDriverForFleet($driver): array
    {
        $location = $driver->location[0] ?? null;
        return [
            'id' => (int) $driver->id,
            'name' => $driver->name,
            'email' => $driver->email,
            'phone' => $driver->phone,
            'country_code' => $driver->country_code,
            'profile_image' => $driver->profile_image?->original_url,
            'is_online' => (int) $driver->is_online,
            'is_on_ride' => (int) $driver->is_on_ride,
            'is_verified' => (int) $driver->is_verified,
            'fleet_manager_id' => (int) $driver->fleet_manager_id,
            'lat' => (float) ($location['lat'] ?? 0),
            'lng' => (float) ($location['lng'] ?? 0),
            'bearing' => (float) ($location['bearing'] ?? 0),
            'vehicle' => [
                'vehicle_type_id' => $driver->vehicle_info?->vehicle_type_id,
                'vehicle_type_image_url' => $driver->vehicle_info?->vehicle?->vehicle_image?->original_url,
                'vehicle_type_map_icon_url' => $driver->vehicle_info?->vehicle?->vehicle_map_icon?->original_url,
                'name' => $driver->ambulance?->name ?? $driver->vehicle_info?->vehicle?->name,
                'description' => $driver->ambulance?->description ?? $driver->vehicle_info?->vehicle?->description,
                'plate_number' => $driver->vehicle_info?->plate_number,
                'color' => $driver->vehicle_info?->color,
                'model' => $driver->vehicle_info?->model,
                'seat' => $driver->vehicle_info?->seat,
            ],
            'updated_at' => $driver->updated_at->toDateTimeString(),
        ];
    }

    public function broadcastFleetUpdate(int $fleetManagerId): void
    {
        $fleetData = $this->getFleetDriversData($fleetManagerId);
        broadcast(new FleetDriversLocationBroadcast($fleetManagerId, $fleetData));
    }

    public function setDriverOffline(int $driverId): void
    {
        $metadataStr = Redis::get(self::KEY_DRIVER_METADATA . $driverId);
        $fleetManagerId = null;

        if ($metadataStr) {
            $metadata = json_decode($metadataStr, true);
            $fleetManagerId = $metadata['fleet_manager_id'] ?? null;
        }

        Redis::zrem(self::KEY_ONLINE_DRIVERS, (string) $driverId);
        Redis::del(self::KEY_DRIVER_METADATA . $driverId);

        if ($fleetManagerId) {
            Redis::srem(self::KEY_FLEET_DRIVERS . $fleetManagerId, (string) $driverId);
            $this->broadcastFleetUpdate((int) $fleetManagerId);
        }

    }

    public function findNearestDrivers(float $lat, float $lng, float $radiusKm = 10, array $filters = []): array
    {
        $driverIds = Redis::georadius(self::KEY_ONLINE_DRIVERS, $lng, $lat, $radiusKm, 'km', 'ASC');
        if (empty($driverIds)) {
            return [];
        }

        $filteredDrivers = [];
        foreach ($driverIds as $driverId) {
            $metadataStr = Redis::get(self::KEY_DRIVER_METADATA . $driverId);
            if (!$metadataStr) continue;
            $metadata = json_decode($metadataStr, true);
            if (!$metadata) continue;

            $match = true;
            foreach ($filters as $key => $value) {
                if ($key === 'id' && is_array($value)) {
                    if (!in_array($driverId, $value)) {
                        $match = false;
                        break;
                    }
                } elseif (($metadata[$key] ?? null) != $value) {
                    $match = false;
                    break;
                }
            }

            if ($match) {
                $filteredDrivers[] = array_merge($metadata, ['id' => $driverId]);
            }
        }

        return $filteredDrivers;
    }
}
