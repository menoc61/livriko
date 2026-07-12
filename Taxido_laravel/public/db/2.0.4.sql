UPDATE `menu_items` SET `deleted_at` = NULL WHERE `menu_items`.`slug` = 'tx_service_finddriver';
UPDATE `menu_items` SET `deleted_at` = NULL WHERE `menu_items`.`slug` = 'tx_service_categories_finddriver';

DELETE FROM `banners` WHERE `banners`.`id` = 13;


UPDATE `banners`
SET `title` = '{"en":"Find Your Perfect Ride Partner","ar":"ابحث عن شريك رحلتك المثالي","de":"Finden Sie Ihren perfekten Fahrpartner","fr":"Trouvez votre partenaire de trajet idéal"}',
    `updated_at` = NOW()
WHERE `slug` = 'only-pay-for-one-side';


TRUNCATE `sms_templates`;
TRUNCATE `push_notification_templates`;
TRUNCATE `email_templates`;

INSERT INTO `sms_templates` (`id`, `title`, `slug`, `content`, `url`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Driver Incentive Level Completed\"}', 'driver-incentive-level-completed', '{\"en\":\"Congratulations {{driver_name}}! You completed level {{level_number}} and earned a bonus of {{bonus_amount}}!\"}', NULL, NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(2, '{\"en\":\"Ride Request (Driver)\"}', 'ride-request-driver', '{\"en\":\"New Ride Request Available! \\ud83e\\udd11 From {{rider_name}} \\ud83c\\udfaf\"}', NULL, NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(3, '{\"en\":\"Ride Status Update (Driver)\"}', 'ride-status-driver-update', '{\"en\":\"Ride #{{ride_number}} status updated to {{status}}.\"}', NULL, NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(4, '{\"en\":\"Ride Status Update (Rider)\"}', 'ride-status-rider-update', '{\"en\":\"Your Ride #{{ride_number}} status is now {{status}}.\"}', NULL, NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56');


INSERT INTO `push_notification_templates` (`id`, `title`, `slug`, `content`, `url`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"\\ud83c\\udf8a Incentive Level Completed!\"}', 'driver-incentive-level-completed', '{\"en\":\"Congratulations {{driver_name}}! You completed level {{level_number}} by completing {{target_rides}} rides and earned a bonus of {{bonus_amount}}!\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(2, '{\"en\":\"\\ud83d\\udea8 New Ride Alert!\"}', 'ride-status-driver-pending', '{\"en\":\"Ride #{{ride_number}} is waiting for you! \\ud83d\\ude96 Check it out! \\ud83c\\udfc1\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(3, '{\"en\":\"\\ud83d\\udd14 New Ride Request!\"}', 'ride-status-driver-requested', '{\"en\":\"Ride #{{ride_number}} is up for grabs! \\ud83d\\ude97 Ready to roll? \\ud83d\\ude80\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(4, '{\"en\":\"\\ud83d\\udcc5 Ride Locked In!\"}', 'ride-status-driver-scheduled', '{\"en\":\"Gear up for Ride #{{ride_number}}! \\ud83d\\udee3\\ufe0f Let\'s hit the road! \\ud83c\\udf1f\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(5, '{\"en\":\"\\ud83c\\udf89 You\'re On!\"}', 'ride-status-driver-accepted', '{\"en\":\"Ride #{{ride_number}} is yours! \\ud83d\\ude99 Time to shine! \\ud83d\\udca8\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(6, '{\"en\":\"\\ud83c\\udfe0 You\'ve Arrived!\"}', 'ride-status-driver-arrived', '{\"en\":\"Ready for pickup on Ride #{{ride_number}}! \\ud83c\\udf88 Let\'s go! \\ud83d\\ude97\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(7, '{\"en\":\"\\ud83d\\ude80 Ride\'s On!\"}', 'ride-status-driver-started', '{\"en\":\"Ride #{{ride_number}} is rolling! Safe travels! \\ud83c\\udf1f\\ud83d\\ude99\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(8, '{\"en\":\"\\ud83e\\udd73 Ride Done!\"}', 'ride-status-driver-completed', '{\"en\":\"Awesome job on Ride #{{ride_number}}! \\ud83c\\udf89 Keep rocking it! \\ud83d\\ude0a\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(9, '{\"en\":\"\\ud83d\\ude15 Ride Cancelled\"}', 'ride-status-driver-cancelled', '{\"en\":\"Ride #{{ride_number}} was cancelled. Next one\\u2019s coming! \\ud83d\\ude96\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(10, '{\"en\":\"\\ud83d\\udce9 Ride Requested!\"}', 'ride-status-rider-requested', '{\"en\":\"We\\u2019re working on Ride #{{ride_number}}! \\ud83d\\ude97 Stay tuned! \\ud83c\\udf89\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(11, '{\"en\":\"\\ud83d\\ude97 Driver\\u2019s Coming!\"}', 'ride-status-rider-accepted', '{\"en\":\"Your driver for Ride #{{ride_number}} is on the way! \\ud83d\\ude80\\ud83d\\ude0e\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(12, '{\"en\":\"\\ud83c\\udfe0 Driver\\u2019s Here!\"}', 'ride-status-rider-arrived', '{\"en\":\"Your driver for Ride #{{ride_number}} is waiting! \\ud83c\\udf88 Hop in! \\ud83d\\ude97\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(13, '{\"en\":\"\\ud83d\\ude99 Ride Started!\"}', 'ride-status-rider-started', '{\"en\":\"Enjoy your Ride #{{ride_number}}! \\ud83c\\udf89 Safe travels! \\ud83c\\udf1f\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(14, '{\"en\":\"\\ud83c\\udf89 Ride Complete!\"}', 'ride-status-rider-completed', '{\"en\":\"You\\u2019ve arrived with Ride #{{ride_number}}! \\ud83d\\ude0a How was it? \\u2b50\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56'),
(15, '{\"en\":\"\\ud83d\\ude15 Ride Cancelled\"}', 'ride-status-rider-cancelled', '{\"en\":\"Your Ride #{{ride_number}} was cancelled. Book another? \\ud83d\\ude96\"}', '{\"en\":\"\"}', NULL, '2026-03-12 08:59:56', '2026-03-12 08:59:56');


UPDATE `menu_items` SET `deleted_at` = '2026-03-02 20:25:53' WHERE `menu_items`.`slug` = 'tx_service_finddriver';
UPDATE `menu_items` SET `deleted_at` = '2026-03-01 20:26:09' WHERE `menu_items`.`id` = 'tx_service_categories_finddriver';
UPDATE `menu_items` SET `deleted_at` = '2026-03-01 20:26:09' WHERE `menu_items`.`id` = 'tx_service_categories_vehicle_finddriver';
