<?php

namespace Modules\Taxido\Listeners;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\DriverIncentiveLevelCompletedEvent;
use Modules\Taxido\Services\NotificationService;

class DriverIncentiveLevelCompletedListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     *
     * @param DriverIncentiveLevelCompletedEvent $event
     */
    public function handle(DriverIncentiveLevelCompletedEvent $event): void
    {
        try {
            $incentive = $event->incentive;
            $driver = $incentive->driver;

            if (!$driver) {
                Log::warning('DriverIncentiveLevelCompletedListener: Driver not found', [
                    'incentive_id' => $incentive->id,
                    'driver_id' => $incentive->driver_id,
                ]);
                return;
            }

            // Get driver's preferred language or use default
            $language = $driver->language ?? app()->getLocale();

            $placeholders = [
                'driver_name' => $driver->name,
                'level_number' => $incentive->level_number,
                'bonus_amount' => number_format($incentive->bonus_amount, 2),
                'target_rides' => $incentive->target_rides,
            ];

            // Push, SMS, and Email
            $this->notificationService->send(
                $driver,
                'driver-incentive-level-completed',
                $placeholders,
                ['type' => 'incentive_level', 'id' => (string)$incentive->id]
            );

        } catch (Exception $e) {
            Log::error('DriverIncentiveLevelCompletedListener: ' . $e->getMessage());
        }
    }
}
