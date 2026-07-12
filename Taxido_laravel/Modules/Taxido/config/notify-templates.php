<?php

return [
    'name' => 'Ride',
    'slug' => 'Taxido',
    'email-templates' => [
        'create-ride-driver' => [
            'name' => 'Create Ride (Driver)',
            'description' => 'Sent to the driver when ride is created.',
            'slug' => 'create-ride-driver',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
                ['type' => 'menuitem', 'text' => 'Services', 'action' => '{{services}}'],
                ['type' => 'menuitem', 'text' => 'Service Category', 'action' => '{{service_category}}'],
                ['type' => 'menuitem', 'text' => 'Rider Name', 'action' => '{{rider_name}}'],
                ['type' => 'menuitem', 'text' => 'Bid Status', 'action' => '{{bid_status}}'],
                ['type' => 'menuitem', 'text' => 'Rider Email', 'action' => '{{rider_email}}'],
                ['type' => 'menuitem', 'text' => 'Rider Phone', 'action' => '{{rider_phone}}'],
                ['type' => 'menuitem', 'text' => 'Vehicle Type', 'action' => '{{vehicle_type}}'],
                ['type' => 'menuitem', 'text' => 'Fare Amount', 'action' => '{{fare_amount}}'],
                ['type' => 'menuitem', 'text' => 'Distance', 'action' => '{{distance}}'],
                ['type' => 'menuitem', 'text' => 'Distance Unit', 'action' => '{{distance_unit}}'],
                ['type' => 'menuitem', 'text' => 'Your Company Name', 'action' => '{{company_name}}'],
            ]
        ],

        'create-ride-admin' => [
            'name' => 'Create Ride (Admin)',
            'description' => 'Notifies the admin when new ride is created.',
            'slug' => 'create-ride-admin',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
                ['type' => 'menuitem', 'text' => 'Services', 'action' => '{{services}}'],
                ['type' => 'menuitem', 'text' => 'Service Category', 'action' => '{{service_category}}'],
                ['type' => 'menuitem', 'text' => 'Rider Name', 'action' => '{{rider_name}}'],
                ['type' => 'menuitem', 'text' => 'Bid Status', 'action' => '{{bid_status}}'],
                ['type' => 'menuitem', 'text' => 'Rider Email', 'action' => '{{rider_email}}'],
                ['type' => 'menuitem', 'text' => 'Rider Phone', 'action' => '{{rider_phone}}'],
                ['type' => 'menuitem', 'text' => 'Vehicle Type', 'action' => '{{vehicle_type}}'],
                ['type' => 'menuitem', 'text' => 'Fare Amount', 'action' => '{{fare_amount}}'],
                ['type' => 'menuitem', 'text' => 'Distance', 'action' => '{{distance}}'],
                ['type' => 'menuitem', 'text' => 'Distance Unit', 'action' => '{{distance_unit}}'],
                ['type' => 'menuitem', 'text' => 'Your Company Name', 'action' => '{{company_name}}'],
            ]
        ],

        'ride-request-driver' => [
            'name' => 'Ride Request (Driver)',
            'description' => 'Alerts the driver of a new ride request.',
            'slug' => 'ride-request-driver',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Locations', 'action' => '{{locations}}'],
                ['type' => 'menuitem', 'text' => 'Services', 'action' => '{{services}}'],
                ['type' => 'menuitem', 'text' => 'Service Category', 'action' => '{{service_category}}'],
                ['type' => 'menuitem', 'text' => 'Vehicle Type', 'action' => '{{vehicle_type}}'],
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Rider Name', 'action' => '{{rider_name}}'],
                ['type' => 'menuitem', 'text' => 'Rider Phone', 'action' => '{{rider_phone}}'],
                ['type' => 'menuitem', 'text' => 'Fare Amount', 'action' => '{{fare_amount}}'],
                ['type' => 'menuitem', 'text' => 'Distance', 'action' => '{{distance}}'],
                ['type' => 'menuitem', 'text' => 'Distance Unit', 'action' => '{{distance_unit}}'],
                ['type' => 'menuitem', 'text' => 'Zone', 'action' => '{{zone}}'],
            ]
        ],

        'create-withdraw-request-admin' => [
            'name' => 'Create Withdraw Request (Admin)',
            'description' => 'Alerts the Admin of a new withdraw request.',
            'slug' => 'create-withdraw-request-admin',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Amount', 'action' => '{{amount}}'],
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
            ]
        ],

        'update-withdraw-request-driver' => [
            'name' => 'Update Withdraw Request (Driver)',
            'description' => 'Update the Driver about the status of their Withdraw Request',
            'slug' => 'update-withdraw-request-driver',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Amount', 'action' => '{{amount}}'],
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Status', 'action' => '{{status}}'],
            ]
        ],

        'bid-status-driver' => [
            'name' => 'Bid Status (Driver)',
            'description' => 'Sent to the driver when status of their bid is changed.',
            'slug' => 'bid-status-driver',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Rider Name', 'action' => '{{rider_name}}'],
                ['type' => 'menuitem', 'text' => 'Bid Status', 'action' => '{{bid_status}}'],
                ['type' => 'menuitem', 'text' => 'Your Company Name', 'action' => '{{company_name}}'],
            ]
        ],

        'driver-document-status-update' => [
            'name' => 'Driver Document Status Update',
            'description' => 'Sent to the driver when a document status is updated.',
            'slug' => 'driver-document-status-update',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Document Name', 'action' => '{{document_name}}'],
                ['type' => 'menuitem', 'text' => 'Status', 'action' => '{{status}}'],
                ['type' => 'menuitem', 'text' => 'Your Company Name', 'action' => '{{company_name}}'],
            ]
        ],

        'referral-bonus-credited' => [
            'name' => 'Referral Bonus Credited',
            'description' => 'Sent when a referral bonus is credited to the referrer',
            'slug' => 'referral-bonus-credited',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Referrer Name', 'action' => '{{referrer_name}}'],
                ['type' => 'menuitem', 'text' => 'Bonus Amount', 'action' => '{{bonus_amount}}'],
                ['type' => 'menuitem', 'text' => 'Referred Type', 'action' => '{{referred_type}}'],
                ['type' => 'menuitem', 'text' => 'Referred Name', 'action' => '{{referred_name}}'],
                ['type' => 'menuitem', 'text' => 'Ride Amount', 'action' => '{{ride_amount}}'],
                ['type' => 'menuitem', 'text' => 'Referrer Percentage', 'action' => '{{referrer_percentage}}'],
                ['type' => 'menuitem', 'text' => 'Your Company Name', 'action' => '{{company_name}}'],
            ]
        ],

        'driver-incentive-level-completed' => [
            'name' => 'Driver Incentive Level Completed',
            'description' => 'Sent when a driver completes an incentive level',
            'slug' => 'driver-incentive-level-completed',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Level Number', 'action' => '{{level_number}}'],
                ['type' => 'menuitem', 'text' => 'Target Rides', 'action' => '{{target_rides}}'],
                ['type' => 'menuitem', 'text' => 'Bonus Amount', 'action' => '{{bonus_amount}}'],
                ['type' => 'menuitem', 'text' => 'Period Type', 'action' => '{{period_type}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Number', 'action' => '{{next_level_number}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Target', 'action' => '{{next_level_target}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Bonus', 'action' => '{{next_level_bonus}}'],
                ['type' => 'menuitem', 'text' => 'Your Company Name', 'action' => '{{company_name}}'],
            ]
        ],
    ],

    'sms-templates' => [
        'ride-request-driver' => [
            'name' => 'Ride Request (Driver)',
            'description' => 'Alerts the driver of a new ride request.',
            'slug' => 'ride-request-driver',
            'content' => 'New Ride Request Available! 🤑 From {{rider_name}} 🎯',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Locations', 'action' => '{{locations}}'],
                ['type' => 'menuitem', 'text' => 'Services', 'action' => '{{services}}'],
                ['type' => 'menuitem', 'text' => 'Service Category', 'action' => '{{service_category}}'],
                ['type' => 'menuitem', 'text' => 'Vehicle Type', 'action' => '{{vehicle_type}}'],
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Rider Name', 'action' => '{{rider_name}}'],
                ['type' => 'menuitem', 'text' => 'Rider Phone', 'action' => '{{rider_phone}}'],
                ['type' => 'menuitem', 'text' => 'Fare Amount', 'action' => '{{fare_amount}}'],
                ['type' => 'menuitem', 'text' => 'Distance', 'action' => '{{distance}}'],
                ['type' => 'menuitem', 'text' => 'Distance Unit', 'action' => '{{distance_unit}}'],
                ['type' => 'menuitem', 'text' => 'Zone', 'action' => '{{zone}}'],
            ]
        ],
        'driver-incentive-level-completed' => [
            'name' => 'Driver Incentive Level Completed',
            'description' => 'Sent when a driver completes an incentive level',
            'slug' => 'driver-incentive-level-completed',
            'content' => 'Congratulations {{driver_name}}! You completed level {{level_number}} and earned a bonus of {{bonus_amount}}!',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Level Number', 'action' => '{{level_number}}'],
                ['type' => 'menuitem', 'text' => 'Target Rides', 'action' => '{{target_rides}}'],
                ['type' => 'menuitem', 'text' => 'Bonus Amount', 'action' => '{{bonus_amount}}'],
                ['type' => 'menuitem', 'text' => 'Period Type', 'action' => '{{period_type}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Number', 'action' => '{{next_level_number}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Target', 'action' => '{{next_level_target}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Bonus', 'action' => '{{next_level_bonus}}'],
                ['type' => 'menuitem', 'text' => 'Your Company Name', 'action' => '{{company_name}}'],
            ]
        ],
        'ride-status-driver-update' => [
            'name' => 'Ride Status Update (Driver)',
            'description' => 'Sent to the driver when ride status is updated.',
            'slug' => 'ride-status-driver-update',
            'content' => 'Ride #{{ride_number}} status updated to {{status}}.',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
                ['type' => 'menuitem', 'text' => 'Status', 'action' => '{{status}}'],
            ]
        ],
        'ride-status-rider-update' => [
            'name' => 'Ride Status Update (Rider)',
            'description' => 'Sent to the rider when ride status is updated.',
            'slug' => 'ride-status-rider-update',
            'content' => 'Your Ride #{{ride_number}} status is now {{status}}.',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
                ['type' => 'menuitem', 'text' => 'Status', 'action' => '{{status}}'],
            ]
        ],
    ],

    'push-notification-templates' => [
        'driver-incentive-level-completed' => [
            'name' => 'Driver Incentive Level Completed',
            'description' => 'Sent when a driver completes an incentive level',
            'slug' => 'driver-incentive-level-completed',
            'title' => '🎊 Incentive Level Completed!',
            'content' => 'Congratulations {{driver_name}}! You completed level {{level_number}} by completing {{target_rides}} rides and earned a bonus of {{bonus_amount}}!',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Driver Name', 'action' => '{{driver_name}}'],
                ['type' => 'menuitem', 'text' => 'Level Number', 'action' => '{{level_number}}'],
                ['type' => 'menuitem', 'text' => 'Target Rides', 'action' => '{{target_rides}}'],
                ['type' => 'menuitem', 'text' => 'Bonus Amount', 'action' => '{{bonus_amount}}'],
                ['type' => 'menuitem', 'text' => 'Period Type', 'action' => '{{period_type}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Number', 'action' => '{{next_level_number}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Target', 'action' => '{{next_level_target}}'],
                ['type' => 'menuitem', 'text' => 'Next Level Bonus', 'action' => '{{next_level_bonus}}'],
                ['type' => 'menuitem', 'text' => 'Your Company Name', 'action' => '{{company_name}}'],
            ]
        ],
        'ride-status-driver-pending' => [
            'name' => 'Ride Pending (Driver)',
            'description' => 'Sent to the driver when ride is pending.',
            'slug' => 'ride-status-driver-pending',
            'title' => '🚨 New Ride Alert!',
            'content' => 'Ride #{{ride_number}} is waiting for you! 🚖 Check it out! 🏁',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-driver-requested' => [
            'name' => 'Ride Requested (Driver)',
            'description' => 'Sent to the driver when ride is requested.',
            'slug' => 'ride-status-driver-requested',
            'title' => '🔔 New Ride Request!',
            'content' => 'Ride #{{ride_number}} is up for grabs! 🚗 Ready to roll? 🚀',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-driver-scheduled' => [
            'name' => 'Ride Scheduled (Driver)',
            'description' => 'Sent to the driver when ride is scheduled.',
            'slug' => 'ride-status-driver-scheduled',
            'title' => '📅 Ride Locked In!',
            'content' => "Gear up for Ride #{{ride_number}}! 🛣️ Let's hit the road! 🌟",
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-driver-accepted' => [
            'name' => 'Ride Accepted (Driver)',
            'description' => 'Sent to the driver when ride is accepted.',
            'slug' => 'ride-status-driver-accepted',
            'title' => "🎉 You're On!",
            'content' => 'Ride #{{ride_number}} is yours! 🚙 Time to shine! 💨',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-driver-arrived' => [
            'name' => 'Driver Arrived',
            'description' => 'Sent when driver arrived at pickup.',
            'slug' => 'ride-status-driver-arrived',
            'title' => "🏠 You've Arrived!",
            'content' => "Ready for pickup on Ride #{{ride_number}}! 🎈 Let's go! 🚗",
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-driver-started' => [
            'name' => 'Ride Started (Driver)',
            'description' => 'Sent to the driver when ride is started.',
            'slug' => 'ride-status-driver-started',
            'title' => "🚀 Ride's On!",
            'content' => "Ride #{{ride_number}} is rolling! Safe travels! 🌟🚙",
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-driver-completed' => [
            'name' => 'Ride Completed (Driver)',
            'description' => 'Sent to the driver when ride is completed.',
            'slug' => 'ride-status-driver-completed',
            'title' => '🥳 Ride Done!',
            'content' => 'Awesome job on Ride #{{ride_number}}! 🎉 Keep rocking it! 😊',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-driver-cancelled' => [
            'name' => 'Ride Cancelled (Driver)',
            'description' => 'Sent to the driver when ride is cancelled.',
            'slug' => 'ride-status-driver-cancelled',
            'title' => '😕 Ride Cancelled',
            'content' => "Ride #{{ride_number}} was cancelled. Next one's coming! 🚖",
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-rider-requested' => [
            'name' => 'Ride Requested (Rider)',
            'description' => 'Sent to the rider when ride is requested.',
            'slug' => 'ride-status-rider-requested',
            'title' => '📩 Ride Requested!',
            'content' => 'Were working on Ride #{{ride_number}}! 🚗 Stay tuned! 🎉',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-rider-accepted' => [
            'name' => 'Ride Accepted (Rider)',
            'description' => 'Sent to the rider when ride is accepted.',
            'slug' => 'ride-status-rider-accepted',
            'title' => '🚗 Driver\'s Coming!',
            'content' => 'Your driver for Ride #{{ride_number}} is on the way! 🚀😎',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-rider-arrived' => [
            'name' => 'Driver Arrived (Rider)',
            'description' => 'Sent to the rider when driver arrived.',
            'slug' => 'ride-status-rider-arrived',
            'title' => '🏠 Driver\'s Here!',
            'content' => 'Your driver for Ride #{{ride_number}} is waiting! 🎈 Hop in! 🚗',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-rider-started' => [
            'name' => 'Ride Started (Rider)',
            'description' => 'Sent to the rider when ride is started.',
            'slug' => 'ride-status-rider-started',
            'title' => '🚙 Ride Started!',
            'content' => 'Enjoy your Ride #{{ride_number}}! 🎉 Safe travels! 🌟',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-rider-completed' => [
            'name' => 'Ride Completed (Rider)',
            'description' => 'Sent to the rider when ride is completed.',
            'slug' => 'ride-status-rider-completed',
            'title' => '🎉 Ride Complete!',
            'content' => 'Youve arrived with Ride #{{ride_number}}! 😊 How was it? ⭐',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
        'ride-status-rider-cancelled' => [
            'name' => 'Ride Cancelled (Rider)',
            'description' => 'Sent to the rider when ride is cancelled.',
            'slug' => 'ride-status-rider-cancelled',
            'title' => '😕 Ride Cancelled',
            'content' => 'Your Ride #{{ride_number}} was cancelled. Book another? 🚖',
            'shortcodes' => [
                ['type' => 'menuitem', 'text' => 'Ride Number', 'action' => '{{ride_number}}'],
            ]
        ],
    ],
];
