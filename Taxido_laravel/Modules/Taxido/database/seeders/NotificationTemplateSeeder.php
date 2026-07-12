<?php

namespace Modules\Taxido\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PushNotificationTemplate;
use App\Models\SmsTemplate;

class NotificationTemplateSeeder extends Seeder
{
    public function run()
    {
        $pushTemplates = [
            [
                'slug' => 'driver-incentive-level-completed',
                'title' => ['en' => '🎊 Incentive Level Completed!'],
                'content' => ['en' => 'Congratulations {{driver_name}}! You completed level {{level_number}} by completing {{target_rides}} rides and earned a bonus of {{bonus_amount}}!'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-pending',
                'title' => ['en' => '🚨 New Ride Alert!'],
                'content' => ['en' => 'Ride #{{ride_number}} is waiting for you! 🚖 Check it out! 🏁'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-requested',
                'title' => ['en' => '🔔 New Ride Request!'],
                'content' => ['en' => 'Ride #{{ride_number}} is up for grabs! 🚗 Ready to roll? 🚀'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-scheduled',
                'title' => ['en' => '📅 Ride Locked In!'],
                'content' => ['en' => "Gear up for Ride #{{ride_number}}! 🛣️ Let's hit the road! 🌟"],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-accepted',
                'title' => ['en' => "🎉 You're On!"],
                'content' => ['en' => 'Ride #{{ride_number}} is yours! 🚙 Time to shine! 💨'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-arrived',
                'title' => ['en' => "🏠 You've Arrived!"],
                'content' => ['en' => "Ready for pickup on Ride #{{ride_number}}! 🎈 Let's go! 🚗"],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-started',
                'title' => ['en' => "🚀 Ride's On!"],
                'content' => ['en' => "Ride #{{ride_number}} is rolling! Safe travels! 🌟🚙"],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-completed',
                'title' => ['en' => '🥳 Ride Done!'],
                'content' => ['en' => 'Awesome job on Ride #{{ride_number}}! 🎉 Keep rocking it! 😊'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-cancelled',
                'title' => ['en' => '😕 Ride Cancelled'],
                'content' => ['en' => "Ride #{{ride_number}} was cancelled. Next one’s coming! 🚖"],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-rider-requested',
                'title' => ['en' => '📩 Ride Requested!'],
                'content' => ['en' => 'We’re working on Ride #{{ride_number}}! 🚗 Stay tuned! 🎉'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-rider-accepted',
                'title' => ['en' => '🚗 Driver’s Coming!'],
                'content' => ['en' => 'Your driver for Ride #{{ride_number}} is on the way! 🚀😎'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-rider-arrived',
                'title' => ['en' => '🏠 Driver’s Here!'],
                'content' => ['en' => 'Your driver for Ride #{{ride_number}} is waiting! 🎈 Hop in! 🚗'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-rider-started',
                'title' => ['en' => '🚙 Ride Started!'],
                'content' => ['en' => 'Enjoy your Ride #{{ride_number}}! 🎉 Safe travels! 🌟'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-rider-completed',
                'title' => ['en' => '🎉 Ride Complete!'],
                'content' => ['en' => 'You’ve arrived with Ride #{{ride_number}}! 😊 How was it? ⭐'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-rider-cancelled',
                'title' => ['en' => '😕 Ride Cancelled'],
                'content' => ['en' => 'Your Ride #{{ride_number}} was cancelled. Book another? 🚖'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-rider-new-bid',
                'title' => ['en' => '💰 New Bid Received!'],
                'content' => ['en' => 'Driver {{driver_name}} bid {{bid_amount}} for Ride #{{ride_number}}! 🏎️'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-status-driver-bid-rejected',
                'title' => ['en' => '😞 Bid Rejected'],
                'content' => ['en' => 'Your bid for Ride #{{ride_number}} was not accepted. Try again! 🚖'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'sos-alert-user',
                'title' => ['en' => '🚨 SOS Alert Active'],
                'content' => ['en' => 'Your SOS alert for Ride #{{ride_number}} has been triggered. Help is on the way! 🆘'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'sos-alert-admin',
                'title' => ['en' => '🚨 SOS EMERGENCY!'],
                'content' => ['en' => 'User {{user_name}} triggered SOS for Ride #{{ride_number}}! 🆘 Location: {{lat}}, {{lng}}'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'driver-verification-status',
                'title' => ['en' => '🚗 Driver Verification Update'],
                'content' => ['en' => 'Congratulations {{driver_name}}! Your verification status has been updated to {{status}}.'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'driver-document-status-update',
                'title' => ['en' => '📄 Document Status Update'],
                'content' => ['en' => 'Hello {{driver_name}}, your document {{document_name}} has been {{status}}.'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'create-ride-admin',
                'title' => ['en' => '📢 New Ride Created'],
                'content' => ['en' => 'A new ride #{{ride_number}} has been created and is now active.'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'referral-bonus-credited',
                'title' => ['en' => '💰 Referral Bonus Credited!'],
                'content' => ['en' => 'Congratulations {{referrer_name}}! You earned {{bonus_amount}} as your friend {{referred_name}} completed their first {{referred_type}}!'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'create-withdraw-request-admin',
                'title' => ['en' => '💸 New Withdraw Request'],
                'content' => ['en' => 'Driver {{driver_name}} has requested a withdrawal of {{amount}}.'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'update-withdraw-request-driver',
                'title' => ['en' => '🔔 Withdraw Request Updated'],
                'content' => ['en' => 'Your withdraw request of {{amount}} has been {{status}}.'],
                'url' => ['en' => ''],
            ],
            [
                'slug' => 'ride-location-changed',
                'title' => ['en' => '📍 Ride Location Updated'],
                'content' => ['en' => 'The pickup or drop-off location for ride #{{ride_number}} has been changed to {{from_to}}.'],
                'url' => ['en' => ''],
            ],
        ];



        foreach ($pushTemplates as $template) {
            PushNotificationTemplate::updateOrCreate(['slug' => $template['slug']], $template);
        }

        $smsTemplates = [
            [
                'title' => ['en' => 'Driver Incentive Level Completed'],
                'slug' => 'driver-incentive-level-completed',
                'content' => ['en' => 'Congratulations {{driver_name}}! You completed level {{level_number}} and earned a bonus of {{bonus_amount}}!'],
            ],
            [
                'title' => ['en' => 'Ride Request (Driver)'],
                'slug' => 'ride-request-driver',
                'content' => ['en' => 'New Ride Request Available! 🤑 From {{rider_name}} 🎯'],
            ],
             [
                'title' => ['en' => 'Ride Status Update (Driver)'],
                'slug' => 'ride-status-driver-update',
                'content' => ['en' => 'Ride #{{ride_number}} status updated to {{status}}.'],
            ],
             [
                'title' => ['en' => 'Ride Status Update (Rider)'],
                'slug' => 'ride-status-rider-update',
                'content' => ['en' => 'Your Ride #{{ride_number}} status is now {{status}}.'],
            ],
        ];

        foreach ($smsTemplates as $template) {
            SmsTemplate::updateOrCreate(['slug' => $template['slug']], $template);
        }
    }
}
