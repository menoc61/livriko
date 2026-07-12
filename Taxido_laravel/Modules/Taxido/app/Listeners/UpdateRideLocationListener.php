<?php

namespace Modules\Taxido\Listeners;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\UpdateRideLocationEvent;
use Modules\Taxido\Services\NotificationService;

class UpdateRideLocationListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateRideLocationEvent $event): void
    {
        try {
            $ride = $event->ride;
            if ($ride->driver) {
                $placeholders = [
                    'driver_name' => $ride->driver->name,
                    'ride_number' => $ride->ride_number,
                    'rider_name' => data_get($ride->rider, 'name', 'User'),
                    'from_to' => implode(" ➡️ ", $ride->locations),
                ];


                $this->notificationService->send(
                    $ride->driver,
                    'ride-location-changed',
                    $placeholders,
                    ['type' => 'ride_location_changed', 'ride_id' => (string)$ride->id]
                );
            }

        } catch (Exception $e) {
            Log::error('UpdateRideLocationListener: ' . $e->getMessage());
        }
    }
}
