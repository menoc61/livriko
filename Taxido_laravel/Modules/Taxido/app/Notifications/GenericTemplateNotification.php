<?php

namespace Modules\Taxido\Notifications;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class GenericTemplateNotification extends Notification
{
    use Queueable;

    protected $slug;
    protected $placeholders;

    /**
     * Create a new notification instance.
     *
     * @param string $slug
     * @param array $placeholders
     */
    public function __construct($slug, $placeholders = [])
    {
        $this->slug = $slug;
        $this->placeholders = $placeholders;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $template = EmailTemplate::where('slug', $this->slug)->first();
        
        $locale = $notifiable->language ?? app()->getLocale();
        $fallback = getDefaultLangLocale();

        if (!$template) {
            return (new MailMessage)
                ->subject('Update from ' . config('app.name'))
                ->line('You have a new update in ' . config('app.name') . '.');
        }

        $title = $template->title[$locale] ?? $template->title[$fallback] ?? '';
        $content = $template->content[$locale] ?? $template->content[$fallback] ?? '';
        
        // Replace placeholders
        foreach ($this->placeholders as $key => $value) {
            $title = str_replace("{{{$key}}}", (string) $value, $title);
            $content = str_replace("{{{$key}}}", (string) $value, $content);
        }

        return (new MailMessage)
            ->subject($title)
            ->markdown('taxido::emails.email-template', [
                'content' => $template, 
                'emailContent' => $content, 
                'locale' => $locale
            ]);
    }
}
