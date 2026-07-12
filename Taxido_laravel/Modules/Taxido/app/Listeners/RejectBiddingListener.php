<?php

namespace Modules\Taxido\Listeners;

use Exception;
use Modules\Taxido\Models\Driver;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\RejectBiddingEvent;
use Modules\Taxido\Services\NotificationService;

class RejectBiddingListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(RejectBiddingEvent $event): void
    {
        try {
            $driver = Driver::where('id', $event->bid?->driver_id)->first();
            if ($driver) {
                $placeholders = [
                    'driver_name' => $driver->name,
                    'ride_number' => $event->bid->ride_request?->ride_number,
                    'rider_name' => $event->bid->ride_request?->rider['name'] ?? 'User',
                    'bid_status' => 'rejected',
                ];


                $this->notificationService->send(
                    $driver,
                    'ride-status-driver-bid-rejected',
                    $placeholders,
                    ['type' => 'bid_status', 'id' => (string)$event->bid->id]
                );
            }

        } catch (Exception $e) {
            Log::error("RejectBiddingListener: " . $e?->getMessage());
        }
    }
}
