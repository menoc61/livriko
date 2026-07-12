<?php

namespace App\Traits;

use App\Models\PushNotificationTemplate;
use Illuminate\Support\Facades\Log;

trait SendPushNotificationTrait
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
    public function sendPushNotification($notifiable, $slug, $placeholders = [], $data = [])
    {
        $payload = $this->getPushPayload($notifiable, $slug, $placeholders, $data);
        if ($payload) {
            pushNotification($payload);
        }
    }

    /**
     * Build the push notification payload
     */
    public function getPushPayload($notifiable, $slug, $placeholders = [], $data = [])
    {
        try {
            if (!$notifiable) {
                return null;
            }

            // Fetch Template
            $template = PushNotificationTemplate::where('slug', $slug)->first();

            if (!$template) {
                Log::warning("Push notification template not found for slug: {$slug}");
                return null;
            }

            // Use data_get for safety in case $notifiable is an array or object
            $userLocale = data_get($notifiable, 'language');
            $locale = $userLocale ?? app()->getLocale();
            $fallback = getDefaultLangLocale();

            // Raw Values
            $title_raw = $template->title;
            $content_raw = $template->content;
            $url_raw = $template->url;

            // Resolve title
            if (is_array($title_raw)) {
                $title = $title_raw[$locale] ?? $title_raw[$fallback] ?? reset($title_raw) ?? '';
            } else {
                $title = (string) $title_raw;
            }

            // Resolve content
            if (is_array($content_raw)) {
                $content = $content_raw[$locale] ?? $content_raw[$fallback] ?? reset($content_raw) ?? '';
            } else {
                $content = (string) $content_raw;
            }

            // Resolve URL
            if (is_array($url_raw)) {
                $url = $url_raw[$locale] ?? $url_raw[$fallback] ?? reset($url_raw) ?? '';
            } else {
                $url = (string) $url_raw;
            }

            // Replace placeholders
            foreach ($placeholders as $key => $value) {
                $title = str_replace("{{{$key}}}", (string) $value, $title);
                $content = str_replace("{{{$key}}}", (string) $value, $content);
            }

            // Final check to prevent "New Notification" or empty alerts
            $finalTitle = (!empty($title)) ? $title : "Notification from " . config('app.name');
            $finalContent = (!empty($content)) ? $content : "You have a new update. Please check the app.";

            // Build notification structure for FCM v1
            $notification = [
                'message' => [
                    'notification' => [
                        'title' => (string) $finalTitle,
                        'body' => (string) $finalContent,
                    ],
                    'data' => array_merge([
                        'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                        'title' => (string) $finalTitle,
                        'body' => (string) $finalContent,
                        'message' => (string) $finalContent,
                        'url' => (string) $url,
                    ], array_map('strval', $data)),
                ],
            ];

            // Use token if available, otherwise fallback to topic
            $token = data_get($notifiable, 'fcm_token');
            $userId = data_get($notifiable, 'id');

            if ($token) {
                $notification['message']['token'] = (string) $token;
            } elseif ($userId) {
                $notification['message']['topic'] = "user_" . $userId;
            } else {
                return null;
            }

            return $notification;

        } catch (\Exception $e) {
            Log::error("SendPushNotificationTrait Exception: " . $e->getMessage(), [
                'slug' => $slug,
                'trace' => $e->getTraceAsString()
            ]);

            return null;
        }
    }
}


