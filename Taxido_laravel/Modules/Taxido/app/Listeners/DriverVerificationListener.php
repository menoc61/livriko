<?php

namespace Modules\Taxido\Listeners;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\DriverVerificationEvent;
use Modules\Taxido\Services\NotificationService;

class DriverVerificationListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     *
     * @param DriverVerificationEvent $event
     */
    public function handle(DriverVerificationEvent $event): void
    {
        try {
            $driver = $event->driver;
            
            if ($driver) {
                $placeholders = [
                    'driver_name' => $driver->name,
                    'status' => $event->status,
                ];

                $this->notificationService->send(
                    $driver,
                    'driver-verification-status',
                    $placeholders,
                    ['type' => 'driver_verification', 'status' => $event->status]
                );
            }

        } catch (Exception $e) {
            Log::error('DriverVerificationListener: ' . $e?->getMessage());
        }
    }
}
