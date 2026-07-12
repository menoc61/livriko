<?php

namespace Modules\Taxido\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Models\NotificationLog;
use App\Traits\SendPushNotificationTrait;

class NotificationService
{
    use SendPushNotificationTrait;

    /**
     * Send instant push notification and log SMS/Email for background processing.
     *
     * @param User $user
     * @param string $slug
     * @param array $placeholders
     * @param array $extraData
     * @return void
     */
    public function send($user, $slug, $placeholders = [], $extraData = [], $channels = ['push', 'sms', 'email'])
    {
        $this->sendToUsers([$user], $slug, $placeholders, $extraData, $channels);
    }

    /**
     * Send notifications to multiple users in parallel (batch)
     */
    public function sendToUsers($users, $slug, $placeholders = [], $extraData = [], $channels = ['push', 'sms', 'email'])
    {
        try {
            $pushPayloads = [];

            foreach ($users as $user) {
                if (!$user) continue;

                // 1. Prepare Push Notification
                if (in_array('push', $channels)) {
                    try {
                        $payload = $this->getPushPayload($user, $slug, $placeholders, $extraData);
                        if ($payload) $pushPayloads[] = $payload;
                    } catch (\Exception $e) {
                        Log::error("Push notification prep fail for user " . data_get($user, 'id') . ": " . $e->getMessage());
                    }
                }

                // 2. Buffer SMS
                if (in_array('sms', $channels)) {
                    try {
                        $this->bufferNotification($user, 'sms', $slug, $placeholders);
                    } catch (\Exception $e) {
                        Log::error("SMS buffering fail for user " . data_get($user, 'id') . ": " . $e->getMessage());
                    }
                }

                // 3. Buffer Email
                if (in_array('email', $channels)) {
                    try {
                        $this->bufferNotification($user, 'email', $slug, $placeholders);
                    } catch (\Exception $e) {
                        Log::error("Email buffering fail for user " . data_get($user, 'id') . ": " . $e->getMessage());
                    }
                }
            }

            // Send all push notifications in parallel
            if (!empty($pushPayloads)) {
                pushNotificationMulti($pushPayloads);
            }

        } catch (\Exception $e) {
            Log::error("NotificationService Global Exception: " . $e->getMessage());
        }
    }


    /**
     * Buffer a notification to the database for later processing via scheduler.
     *
     * @param User|array $user
     * @param string $type
     * @param string $slug
     * @param array $placeholders
     * @return void
     */
    protected function bufferNotification($user, $type, $slug, $placeholders)
    {
        $userId = data_get($user, 'id');
        if (!$userId) return;

        NotificationLog::create([
            'user_id' => (int) $userId,
            'notification_type' => $type,
            'template_slug' => $slug,
            'placeholders' => $placeholders,
            'status' => 'pending',
        ]);
    }
}

