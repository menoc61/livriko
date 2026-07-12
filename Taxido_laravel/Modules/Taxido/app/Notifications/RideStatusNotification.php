<?php

namespace Modules\Taxido\Notifications;

use App\Enums\RoleEnum;
use Illuminate\Bus\Queueable;
use Modules\Taxido\Models\Ride;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Taxido\Enums\RoleEnum as EnumsRoleEnum;

class RideStatusNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $ride;
    private $roleName;
    private $language;

    public function __construct(Ride $ride, $roleName, $language = null)
    {
        $this->ride = $ride;
        $this->roleName = $roleName;
        $this->language = $language ?? getDefaultLangLocale();
        app()->setLocale($this->language);
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $placeholders = $this->getPlaceholders();
        $mail = (new MailMessage)
            ->subject(__('taxido::static.ride.email.subject', $placeholders))
            ->greeting(__('taxido::static.ride.email.greeting', $placeholders))
            ->line(__('taxido::static.ride.email.body'))
            ->line(__('taxido::static.ride.email.details'))
            ->line(__('taxido::static.ride.email.ride_id', $placeholders))
            ->line(__('taxido::static.ride.email.status', $placeholders))
            ->line(__('taxido::static.ride.email.rider', $placeholders))
            ->line(__('taxido::static.ride.email.driver', $placeholders));

        if ($this->roleName === RoleEnum::ADMIN) {
            $mail->line(__('taxido::static.ride.email.footer'));
        }

        return $mail->salutation(__('taxido::static.ride.email.salutation'));
    }

    public function toArray($notifiable): array
    {
        $rideNumber = $this->ride->ride_number;
        $status = strtoupper($this->ride?->ride_status?->slug);
        switch ($status) {
            case 'PENDING':
                return [
                    'title' => "📢 New Ride Pending",
                    'message' => "Ride #$rideNumber is pending review. Please monitor. 📋",
                    'type' => 'ride',
                ];
            case 'REQUESTED':
                return [
                    'title' => "🔔 Ride Request Received",
                    'message' => "Ride #$rideNumber has been requested. Awaiting driver assignment. 🚖",
                    'type' => 'ride',
                ];
            case 'SCHEDULED':
                return [
                    'title' => "📅 Ride Scheduled",
                    'message' => "Ride #$rideNumber is scheduled. All details confirmed. ✅",
                    'type' => 'ride',
                ];
            case 'ACCEPTED':
                return [
                    'title' => "✔️ Ride Accepted",
                    'message' => "Ride #$rideNumber has been accepted by the driver. 🚗",
                    'type' => 'ride',
                ];
            case 'REJECTED':
                return [
                    'title' => "🚫 Ride Rejected",
                    'message' => "Ride #$rideNumber was rejected. Please review for reassignment. 🔍",
                    'type' => 'ride',
                ];
            case 'ARRIVED':
                return [
                    'title' => "📍 Driver Arrived",
                    'message' => "Driver has arrived for Ride #$rideNumber. Ready for pickup. 🏠",
                    'type' => 'ride',
                ];
            case 'STARTED':
                return [
                    'title' => "🚀 Ride Started",
                    'message' => "Ride #$rideNumber is in progress. Monitor for updates. 🌟",
                    'type' => 'ride',
                ];
            case 'CANCELLED':
                return [
                    'title' => "❌ Ride Cancelled",
                    'message' => "Ride #$rideNumber has been cancelled. Review details. 📝",
                    'type' => 'ride',
                ];
            case 'COMPLETED':
                return [
                    'title' => "🎉 Ride Completed",
                    'message' => "Ride #$rideNumber has been successfully completed. Great job! 🥳",
                    'type' => 'ride',
                ];
            default:
                return [
                    'title' => "🔔 Ride Update",
                    'message' => "Ride #$rideNumber status updated to $status. Please check details. 📋",
                    'type' => 'ride',
                ];
        }
    }

    private function getPlaceholders(): array
    {
        return [
            'ride_number' => $this->ride->ride_number,
            'rider_name' => $this->ride->rider ? $this->ride?->rider['name'] : 'N/A',
            'driver_name' => $this->ride->driver ? $this->ride?->driver?->name : 'N/A',
            'status' => strtoupper($this->ride?->ride_status?->name),
            'roleName' => $this->roleName,
        ];
    }
}
