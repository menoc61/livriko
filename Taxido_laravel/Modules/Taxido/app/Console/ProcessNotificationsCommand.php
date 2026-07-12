<?php

namespace Modules\Taxido\Console;

use App\Models\SmsTemplate;
use Illuminate\Console\Command;
use Modules\Taxido\Models\NotificationLog;
use Modules\Taxido\Notifications\GenericTemplateNotification;
use Illuminate\Support\Facades\Log;

class ProcessNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taxido:send-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process and send pending SMS and Email notifications from the buffer.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pendingNotifications = NotificationLog::where('status', 'pending')
            ->limit(50) // Process in batches
            ->get();

        if ($pendingNotifications->isEmpty()) {
            return;
        }

        $this->info("Processing {$pendingNotifications->count()} pending notifications...");

        foreach ($pendingNotifications as $notification) {
            try {
                $user = $notification->user;
                if (!$user) {
                    $notification->update(['status' => 'failed', 'error_message' => 'User not found']);
                    continue;
                }

                if ($notification->notification_type === 'sms') {
                    $this->sendSms($user, $notification);
                } elseif ($notification->notification_type === 'email') {
                    $this->sendEmail($user, $notification);
                }

                $notification->update(['status' => 'sent']);

            } catch (\Exception $e) {
                Log::error("ProcessNotificationsCommand Error: " . $e->getMessage());
                $notification->increment('retry_count');
                if ($notification->retry_count >= 3) {
                    $notification->update(['status' => 'failed', 'error_message' => $e->getMessage()]);
                }
            }
        }

        $this->info('Batch processing completed.');
    }

    /**
     * Send SMS notification
     */
    protected function sendSms($user, $notification)
    {
        $template = SmsTemplate::where('slug', $notification->template_slug)->first();
        if (!$template) {
            throw new \Exception("SMS Template not found: {$notification->template_slug}");
        }

        $locale = $user->language ?? app()->getLocale();
        $fallback = getDefaultLangLocale();
        $content = $template->content[$locale] ?? $template->content[$fallback] ?? '';

        foreach ($notification->placeholders as $key => $value) {
            $content = str_replace("{{{$key}}}", (string) $value, $content);
        }

        if ($user->phone) {
            sendSMS($user->phone, $content);
        }
    }

    /**
     * Send Email notification
     */
    protected function sendEmail($user, $notification)
    {
        $user->notify(new GenericTemplateNotification($notification->template_slug, $notification->placeholders));
    }
}
