<?php

namespace Modules\Taxido\Listeners;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Enums\ServiceCategoryEnum;
use Modules\Taxido\Events\RideRequestEvent;
use Modules\Taxido\Services\NotificationService;

class RideRequestListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(RideRequestEvent $event): void
    {
        try {
            $rideRequest = $event->rideRequest;
            $settings = getTaxidoSettings();
            $isBidding = (bool) ($settings['activation']['bidding'] ?? false);
            $serviceCategoryType = $rideRequest->service_category ? $rideRequest->service_category->type : null;


            $drivers = $rideRequest->drivers;
            $placeholders = [
                'driver_name' => 'Driver',
                'ride_number' => $rideRequest->ride_number,
                'rider_name' => data_get($rideRequest->rider, 'name', 'User'),
                'from_to' => implode(" ➡️ ", $rideRequest->locations),
                'service_name' => $rideRequest->service->name,
                'fare_amount' => $rideRequest->ride_fare,
            ];

            Log::error('NEW RIDE REQUEST: ' , ['placeHolder' => $placeholders]);

            $this->notificationService->sendToUsers(
                $drivers,
                'ride-status-driver-requested',
                $placeholders,
                [
                    'service_request_id' => (string) $event->rideRequest->id,
                    'type' => 'service_request'
                ]
            );


        } catch (Exception $e) {
            Log::error('RideRequestListener: ' . $e->getMessage());
        }
    }
}
