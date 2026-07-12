<?php

namespace App\Traits;

use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Models\NotificationLog;

trait SendSmsNotificationTrait
{
    /**
     * Send SMS notification using template
     *
     * @param $notifiable
     * @param string $slug
     * @param array $placeholders
     * @return void
     */
    public function sendSmsNotification($notifiable, $slug, $placeholders = [])
    {
        try {
            if (!$notifiable || !$notifiable->phone) {
                return;
            }

            $template = SmsTemplate::where('slug', $slug)->first();
            $content = '';

            if (!$template) {
                Log::warning("SMS template not found for slug: {$slug}");
                return;
            }

            $locale = $notifiable->language ?? app()->getLocale();
            $fallback = getDefaultLangLocale();
            $content = $template->content[$locale] ?? $template->content[$fallback] ?? (is_array($template->content) && !empty($template->content) ? reset($template->content) : '');

            // Replace placeholders
            foreach ($placeholders as $key => $value) {
                $content = str_replace("{{{$key}}}", (string) $value, $content);
            }

            // Fallback default
            $content = $content ?: "Update from Taxido.";

            $sendTo = '+' . $notifiable->country_code . ($notifiable->phone ?? '');

            if (class_exists(NotificationLog::class)) {
                NotificationLog::create([
                    'user_id' => $notifiable->id,
                    'notification_type' => 'sms',
                    'template_slug' => $slug,
                    'placeholders' => $placeholders,
                    'status' => 'pending',
                ]);
            } else {
                sendSMS($sendTo, $content);
            }

        } catch (\Exception $e) {
            Log::error("SendSmsNotificationTrait Exception: " . $e->getMessage());
        }
    }
}
