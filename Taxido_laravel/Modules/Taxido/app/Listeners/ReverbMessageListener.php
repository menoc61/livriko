<?php

namespace Modules\Taxido\Listeners;

use Laravel\Reverb\Events\MessageReceived;
use Modules\Taxido\Services\DriverStateService;
use Modules\Taxido\Models\Driver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ReverbMessageListener
{

    public function handle(MessageReceived $event): void
    {
        Log::info("Reverb Message Received: " . $event->message);

        $payload = json_decode($event->message, true);

        if (!$payload) {
            return;
        }

        $eventName = $payload['event'] ?? '';
        if (str_starts_with($eventName, 'client-')) {
            Log::info("Processing Client Event: " . $eventName);
            $this->handleClientEvent($eventName, $payload);
        }
    }

    protected function handleClientEvent(string $event, array $payload): void
    {
        $channel = $payload['channel'] ?? '';
        $data = $payload['data'] ?? [];

        Log::info("Channel: " . $channel);

        $driverId = (int) ($data['driver_id'] ?? 0);
        if ($driverId <= 0) {
            if (preg_match('/(?:driver-ride-request-|driver-notification\.)(\d+)/', $channel, $matches)) {
                $driverId = (int) $matches[1];
            }
        }

        Log::info("Extracted Driver ID: " . $driverId);
        if ($driverId <= 0) {
            return;
        }

        switch ($event) {
            case 'client-location-update':
                $this->handleLocationUpdate($driverId, $data);
                break;

            case 'client-status-update':
                $this->handleStatusUpdate($driverId, $data);
                break;
        }
    }

    protected function handleLocationUpdate(int $driverId, array $data): void
    {
        $lat = (float) ($data['lat'] ?? 0);
        $lng = (float) ($data['lng'] ?? 0);
        if ($lat === 0.0 || $lng === 0.0) {
            return;
        }

        $driverState = app(DriverStateService::class);
        $driverInfo = Cache::remember("driver_fleet_meta_{$driverId}", 3600, function () use ($driverId) {
            $driver = Driver::with('vehicle_info')->find($driverId);
            return [
                'fleet_manager_id' => $driver?->fleet_manager_id,
                'name' => $driver?->name,
                'vehicle_info' => [
                    'vehicle_type_id' => $driver->vehicle_info?->vehicle_type_id,
                    'vehicle_type_image_url' => $driver->vehicle_info?->vehicle?->vehicle_image?->original_url,
                    'vehicle_type_map_icon_url' => $driver->vehicle_info?->vehicle?->vehicle_map_icon?->original_url,
                    'name' => $driver->ambulance?->name ?? $driver->vehicle_info?->vehicle?->name,
                    'description' => $driver->ambulance?->description ?? $driver->vehicle_info?->vehicle?->description,
                    'plate_number' => $driver->vehicle_info?->plate_number,
                    'color' => $driver->vehicle_info?->color,
                    'model' => $driver->vehicle_info?->model,
                ],
            ];
        });

        $metadata = [
            'id' => (string) $driverId,
            'name' => $driverInfo['name'] ?? 'Driver',
            'is_online' => ($data['is_online'] ?? true) ? '1' : '0',
            'is_on_ride' => ($data['is_on_ride'] ?? false) ? '1' : '0',
            'is_verified' => ($data['is_verified'] ?? false) ? '1' : '0',
            'fleet_manager_id' => (string) ($driverInfo['fleet_manager_id'] ?? 0),
            'vehicle' => $driverInfo['vehicle'] ?? null,
            'updated_at' => now()->toDateTimeString(),
        ];

        $driverState->updateDriverLocation($driverId, $lat, $lng, $metadata);
        $cacheKey = "driver_location_db_sync_{$driverId}";
        if (!Cache::has($cacheKey)) {
            Driver::where('id', $driverId)->update([
                'location' => [['lat' => $lat, 'lng' => $lng]],
            ]);
            Cache::put($cacheKey, true, 60);
        }
    }


    protected function handleStatusUpdate(int $driverId, array $data): void
    {
        $isOnline = (bool) ($data['is_online'] ?? false);
        Driver::where('id', $driverId)->update([
            'is_online' => $isOnline,
        ]);

        if (!$isOnline) {
            app(DriverStateService::class)->setDriverOffline($driverId);
        } else {
            $driver = Driver::find($driverId);
            if ($driver && $driver->fleet_manager_id) {
                app(DriverStateService::class)->broadcastFleetUpdate($driver->fleet_manager_id);
            }
        }

    }
}
