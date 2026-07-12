<?php

namespace App\Services;

use Exception;
use App\Models\PushNotificationTemplate;
use Illuminate\Support\Facades\Log;

class SendNotificationService
{
    /**
     * Send push notification using template
     *
     * @param $notifiable
     * @param string $slug
     * @param array $placeholders
     * @param array $data
     * @return void
     */
    public static function sendPushNotification($notifiable, $slug, $placeholders = [], $data = [])
    {
        try {
            if (!$notifiable) {
                return;
            }

            $template = PushNotificationTemplate::where('slug', $slug)->first();
            if (!$template) {
                Log::warning("Push notification template not found for slug: {$slug}");
                return;
            }

            $locale = app()->getLocale();
            $fallback = getDefaultLangLocale();

            $title_raw = $template->title;
            $content_raw = $template->content;
            $url_raw = $template->url;

            if (is_array($title_raw)) {
                $title = $title_raw[$locale] ?? $title_raw[$fallback] ?? (!empty($title_raw) ? reset($title_raw) : '');
            } else {
                $title = (string) $title_raw;
            }

            if (is_array($content_raw)) {
                $content = $content_raw[$locale] ?? $content_raw[$fallback] ?? (!empty($content_raw) ? reset($content_raw) : '');
            } else {
                $content = (string) $content_raw;
            }

            if (is_array($url_raw)) {
                $url = $url_raw[$locale] ?? $url_raw[$fallback] ?? (!empty($url_raw) ? reset($url_raw) : '');
            } else {
                $url = (string) $url_raw;
            }

            // Replace placeholders
            foreach ($placeholders as $key => $value) {
                $title = str_replace("{{{$key}}}", (string) $value, $title);
                $content = str_replace("{{{$key}}}", (string) $value, $content);
            }

            // Build payload
            $notification = [
                'message' => [
                    'notification' => [
                        'title' => $title,
                        'body' => $content,
                        'image' => '',
                    ],
                    'data' => array_merge([
                        'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                        'title' => $title,
                        'body' => $content,
                        'message' => $content,
                        'url' => (string) $url,
                    ], $data),
                ],
            ];

            // Use token if available, otherwise use topic
            if ($notifiable->fcm_token) {
                $notification['message']['token'] = $notifiable->fcm_token;
            } else {
                $notification['message']['topic'] = "user_" . $notifiable?->id;
            }

            pushNotification($notification);

        } catch (Exception $e) {
            Log::error("SendNotificationService Exception: " . $e->getMessage());
        }
    }
}
