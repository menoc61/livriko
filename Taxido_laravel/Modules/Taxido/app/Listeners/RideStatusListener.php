<?php

namespace Modules\Taxido\Listeners;

use Exception;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\RideStatusEvent;
use Modules\Taxido\Services\NotificationService;

class RideStatusListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(RideStatusEvent $event): void
    {
        try {
            $ride = $event->ride;
            $rideStatusSlug = $ride?->ride_status?->slug;

            // Use relationship to get the Model instead of conflicting attribute
            $rider = $ride->rider_id ? \Modules\Taxido\Models\Rider::find($ride->rider_id) : null;
            $driver = $ride->driver;

            $placeholders = [
                'ride_number' => $ride->ride_number,
                'status' => strtoupper($rideStatusSlug),
                'driver_name' => $driver ? ($driver->name ?? 'N/A') : 'N/A',
                'rider_name' => $rider ? ($rider->name ?? 'User') : 'N/A',
            ];

            // Notify Driver
            if ($driver) {
                $this->notificationService->send(
                    $driver,
                    "ride-status-driver-{$rideStatusSlug}",
                    $placeholders,
                    ['type' => 'ride_status', 'ride_id' => (string) $ride->id]
                );
            }

            // Notify Rider
            if ($rider) {
                $this->notificationService->send(
                    $rider,
                    "ride-status-rider-{$rideStatusSlug}",
                    $placeholders,
                    ['type' => 'ride_status', 'ride_id' => (string)$ride->id]
                );
            }

        } catch (Exception $e) {
            Log::error('RideStatusListener: ' . $e->getMessage());
        }
    }
}
