<?php

namespace Modules\Taxido\Listeners;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\SOSAlertEvent;
use Modules\Taxido\Services\NotificationService;

class SOSAlertListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(SOSAlertEvent $event): void
    {
        try {
            $ride = $event->ride;
            $sos = $event->sos;

            // Use relationship to get the Model instead of conflicting attribute
            $rider = $ride->rider_id ? \Modules\Taxido\Models\Rider::find($ride->rider_id) : null;

            $placeholders = [
                'ride_number' => $ride->ride_number,
                'user_name' => $rider ? ($rider->name ?? 'User') : 'N/A',
                'lat' => $ride->rider_location ? $ride->rider_location['lat'] : 'N/A',
                'lng' => $ride->rider_location ? $ride->rider_location['lng'] : 'N/A',
            ];

            // Notify User (Rider)
            if ($rider) {
                $this->notificationService->send(
                    $rider,
                    'sos-alert-user',
                    $placeholders,
                    ['type' => 'sos_alert', 'ride_id' => (string)$ride->id]
                );
            }

            // Notify Admins
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                $this->notificationService->send(
                    $admin,
                    'sos-alert-admin',
                    $placeholders,
                    ['type' => 'sos_alert', 'ride_id' => (string)$ride->id]
                );
            }

        } catch (Exception $e) {
            Log::error('SOSAlertListener: ' . $e?->getMessage());
        }
    }
}
