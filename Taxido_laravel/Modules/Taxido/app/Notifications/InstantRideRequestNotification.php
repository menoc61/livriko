<?php

namespace Modules\Taxido\Notifications;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Models\RideRequest;


class InstantRideRequestNotification extends Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public readonly RideRequest $rideRequest) {}


    public function via(object $notifiable): array
    {
        if ($token = $notifiable?->fcm_token) {
            $this->sendFcmPush($token);
        }

        return ['database'];
    }

    /**
     * Database notification payload (for notification history).
     */
    public function toArray(object $notifiable): array
    {
        $locations = $this->rideRequest->locations ?? [];
        $pickup    = is_array($locations) ? ($locations[0]['address'] ?? 'N/A') : 'N/A';
        $drop      = is_array($locations) ? (end($locations)['address'] ?? 'N/A') : 'N/A';
        return [
            'title'           => 'New Ride Request #' . $this->rideRequest->ride_number,
            'message'         => "Pickup: {$pickup} → Drop: {$drop}",
            'type'            => 'instant_ride_request',
            'ride_request_id' => $this->rideRequest->id,
            'ride_number'     => $this->rideRequest->ride_number,
            'fare'            => $this->rideRequest->total,
            'currency_symbol' => $this->rideRequest->currency_symbol,
        ];
    }

    /**
     * Fire FCM push via project's global helper.
     */
    private function sendFcmPush(string $token): void
    {
        try {

            $locations = $this->rideRequest->locations ?? [];
            $pickup    = is_array($locations) ? ($locations[0]['address'] ?? 'New Ride') : 'New Ride';
            $title = 'New Ride Request';
            $body  = "Pickup: {$pickup} | Fare: {$this->rideRequest->currency_symbol}{$this->rideRequest->total}";
            $payload = [
                'message' => [
                    'token'        => $token,
                    'notification' => [
                        'title' => $title,
                        'body'  => $body,
                        'image' => '',
                    ],
                    'data' => [
                        'click_action'    => 'FLUTTER_NOTIFICATION_CLICK',
                        'title'           => $title,
                        'body'            => $body,
                        'message'         => $body,
                        'type'            => 'instant_ride_request',
                        'ride_request_id' => (string) $this->rideRequest->id,
                        'ride_number'     => (string) $this->rideRequest->ride_number,
                    ],
                ],
            ];

            pushNotification($payload);

        } catch (Exception $e) {
            Log::warning('InstantRideRequestNotification FCM failed', [
                'ride_request_id' => $this->rideRequest->id,
                'error'           => $e->getMessage(),
            ]);
        }
    }
}
