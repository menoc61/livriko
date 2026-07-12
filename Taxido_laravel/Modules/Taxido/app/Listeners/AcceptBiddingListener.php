<?php

namespace Modules\Taxido\Listeners;

use Exception;
use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\AcceptBiddingEvent;
use Modules\Taxido\Enums\RoleEnum as EnumsRoleEnum;
use Modules\Taxido\Services\NotificationService;

class AcceptBiddingListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(AcceptBiddingEvent $event): void
    {
        try {
            $ride = $event->ride;
            
            // Admin Notification
            $admin = User::role(RoleEnum::ADMIN)->first();
            if ($admin) {
                $this->notificationService->send(
                    $admin, 
                    'create-ride-admin', 
                    ['ride_number' => $ride->ride_number], 
                    [], 
                    ['email']
                );
            }

            // Use relationship to get the Model instead of conflicting attribute
            $rider = $ride->rider_id ? \Modules\Taxido\Models\Rider::find($ride->rider_id) : null;
            $driver = $ride->driver;

            // Driver Notification
            if ($driver) {
                $placeholders = [
                    'driver_name' => $driver->name,
                    'ride_number' => $ride->ride_number,
                    'rider_name' => $rider ? ($rider->name ?? 'User') : 'N/A',
                ];

                $this->notificationService->send(
                    $driver,
                    'ride-status-driver-accepted',
                    $placeholders,
                    ['type' => 'accept_bidding', 'ride_id' => (string)$ride->id]
                );
            }

            // Rider Notification
            if ($rider) {
                $placeholders = [
                    'rider_name' => $rider->name ?? 'User',
                    'ride_number' => $ride->ride_number,
                    'driver_name' => $driver ? $driver->name : 'N/A',
                ];

                $this->notificationService->send(
                    $rider,
                    'ride-status-rider-accepted',
                    $placeholders,
                    ['type' => 'accept_bidding', 'ride_id' => (string)$ride->id]
                );
            }

        } catch (Exception $e) {
            Log::error("AcceptBiddingListener: " . $e->getMessage());
        }
    }
}
