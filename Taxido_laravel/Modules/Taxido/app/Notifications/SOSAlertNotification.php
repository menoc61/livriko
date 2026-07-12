<?php

namespace Modules\Taxido\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SOSAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $language;

    public function __construct($ride, $sos, $language = null)
    {
        $this->ride = $ride;
        $this->sos  = $sos;
        $this->language = $language ?? getDefaultLangLocale();
        app()->setLocale($this->language);
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('taxido::static.sos.email.subject'))
            ->greeting(__('taxido::static.sos.email.greeting'))
            ->line(__('taxido::static.sos.email.body'))
            ->line(__('taxido::static.sos.email.ride_id', ['ride_number' => $this->ride->ride_number]))
            ->line(__('taxido::static.sos.email.coordinates', [
                'lat' => $this->sos->location_coordinates['lat'],
                'lng' => $this->sos->location_coordinates['lng']
            ]))
            ->action(__('taxido::static.sos.email.action'), url('/admin/sos-alerts/' . $this->sos->id))
            ->line(__('taxido::static.sos.email.footer'));
    }

    public function toArray($notifiable): array
    {
        return [
            'title'   => __('taxido::static.sos.notification.title'),
            'message' => __('taxido::static.sos.notification.message', ['ride_number' => $this->ride->ride_number]),
            'type'    => 'sos_alert',
        ];
    }
}
