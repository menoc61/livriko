<?php

namespace Modules\Taxido\Listeners;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\CreateBidEvent;
use Modules\Taxido\Services\NotificationService;

class CreateBidListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     *
     * @param CreateBidEvent $event
     */
    public function handle(CreateBidEvent $event): void
    {
        try {
            $user = User::find($event->rideRequest->rider_id);
            if ($user) {
                $placeholders = [
                    'user_name' => $user->name,
                    'ride_number' => $event->rideRequest->ride_number,
                    'bid_amount' => $event->bidAmount,
                    'driver_name' => $event->driver ? $event->driver->name : 'N/A',
                ];

                $this->notificationService->send(
                    $user,
                    'ride-status-rider-new-bid',
                    $placeholders,
                    ['type' => 'create_bid', 'ride_id' => (string)$event->rideRequest->id]
                );

            }

        } catch (Exception $e) {
            Log::error("CreateBidListener: " . $e->getMessage());
        }
    }
}
