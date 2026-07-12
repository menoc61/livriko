ALTER TABLE `services`
CHANGE `type` `type`
ENUM('cab','parcel','freight','ambulance','finddriver')
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci
NULL DEFAULT 'cab';

INSERT INTO `services` (`id`,`name`,`slug`,`description`,`service_image_id`,`service_icon_id`,`type`,`status`,`is_primary`,`created_by_id`,`created_at`,`updated_at`,`deleted_at`) VALUES (5,'{"en":"Find Driver","ar":"العثور على سائق","fr":"Trouver un chauffeur","de":"Treiber finden"}','finddriver','{"en":"Hire a professional and reliable driver","ar":"استأجر سائقًا محترفًا وموثوقًا","fr":"Embauchez un chauffeur professionnel et fiable","de":"Engagieren Sie einen professionellen und zuverlässigen Fahrer"}',12,12,'finddriver',1,0,1,NOW(),NULL,NULL);


INSERT INTO `service_categories` (`id`,`name`,`slug`,`type`,`service_id`,`description`,`service_category_image_id`,`status`,`created_by_id`,`created_at`,`updated_at`,`deleted_at`) VALUES (12,'{"en":"One Way","ar":"طريقة واحدة","fr":"Sens Unique","de":"Ein Weg","es":"Un camino"}','oneway','oneway','5','{"en":"One-way transportation service that takes you safely and comfortably to your destination without a return trip.","ar":"خدمة نقل باتجاه واحد تنقلك بأمان وراحة إلى وجهتك دون الحاجة إلى رحلة عودة.","fr":"Service de transport aller simple vous conduisant en toute sécurité et confort vers votre destination sans retour.","de":"Einweg-Transportservice, der Sie sicher und bequem ohne Rückfahrt an Ihr Ziel bringt."}',1,1,33,'2026-01-12 10:07:42',NULL,NULL),(13,'{"en":"roundtrip","ar":"ذهابا وإيابا","fr":"aller-retour","de":"Rundfahrt","es":"Viaje de ida y vuelta"}','roundtrip','roundtrip','5','{"en":"Round-trip transportation service providing pickup and return travel with comfort and reliability.","ar":"خدمة نقل ذهابًا وإيابًا توفر رحلة مريحة وموثوقة مع العودة إلى نقطة الانطلاق.","fr":"Service de transport aller-retour offrant un trajet confortable et fiable avec retour au point de départ.","de":"Hin- und Rückfahrt-Service mit komfortabler und zuverlässiger Rückkehr zum Ausgangspunkt."}',2,1,1,'2026-01-12 10:13:49',NULL,NULL),(14,'{"en":"outstation","ar":"محطة خارجية","fr":"station éloignée","de":"Außenstation","es":"estación avanzada"}','outstation','outstation','5','{"en":"Outstation transportation service for comfortable and secure travel to destinations outside the city.","ar":"خدمة نقل للمحطات الخارجية لرحلات مريحة وآمنة إلى وجهات خارج المدينة.","fr":"Service de transport hors ville pour des déplacements confortables et sécurisés vers des destinations extérieures.","de":"Außerorts-Transportservice für komfortable und sichere Fahrten zu Zielen außerhalb der Stadt."}',1,1,38,'2026-01-12 10:21:35',NULL,NULL),(15,'{"en":"daily","ar":"يوميًا","fr":"tous les jours","de":"täglich","es":"Diario"}','daily','daily','5','{"en":"Daily transportation service offering consistent and reliable rides for your everyday travel needs.","ar":"خدمة نقل يومية توفر رحلات منتظمة وموثوقة لاحتياجاتك اليومية.","fr":"Service de transport quotidien offrant des trajets réguliers et fiables pour vos besoins journaliers.","de":"Täglicher Transportservice mit regelmäßigen und zuverlässigen Fahrten für Ihre täglichen Bedürfnisse."}',1,1,1,'2026-01-12 10:25:10',NULL,NULL);

INSERT INTO `categories_services` (`id`, `service_category_id`, `service_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 12, 5, '2026-01-12 11:49:09', NULL, NULL),
(10, 15, 5, NULL, NULL, NULL),
(11, 14, 5, NULL, NULL, NULL),
(12, 13, 5, NULL, NULL, NULL);


ALTER TABLE users ADD COLUMN experience INT NULL;


DELETE FROM `menu_items` WHERE `menu_items`.`id` = 159;
DELETE FROM `menu_items` WHERE `menu_items`.`id` = 160;

INSERT INTO `menu_items` (`id`, `label`, `route`, `params`, `slug`, `permission`, `parent`, `module`, `section`, `sort`, `class`, `icon`, `badge`, `badgeable`, `badge_callback`, `menu`, `depth`, `quick_link`, `status`, `role_id`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(159, 'taxido::sidebar.finddriver', NULL, NULL, 'tx_service_finddriver', 'service.index', 0, 1, 'sidebar.home', 9, NULL, 'ri-archive-2-line', 0, NULL, NULL, 1, 0, 0, 1, 0, 1, '2026-01-12 09:34:53', '2026-01-19 06:07:55', NULL),
(164, 'taxido::sidebar.service_categories', 'service-category.finddriver.index', NULL, 'tx_service_categories_finddriver', 'service.index', 159, 1, 'sidebar.home', 8, NULL, 'ri-taxi-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2026-01-19 06:07:55', '2026-01-19 06:07:55', NULL);


ALTER TABLE users
ADD COLUMN `per_day_charge` DECIMAL(10,2) NULL AFTER `experience`,
ADD COLUMN `per_km_charge` DECIMAL(10,2) NULL AFTER `per_day_charge`,
ADD COLUMN `per_hour_charge` DECIMAL(10,2) NULL AFTER `per_km_charge`;

ALTER TABLE users
ADD COLUMN price_type JSON NULL AFTER experience;

ALTER TABLE users
ADD COLUMN gear_type JSON NULL AFTER price_type;

ALTER TABLE `ride_requests` ADD `driver_id` BIGINT NULL AFTER `ambulance_id`;

INSERT INTO users (price_type)
VALUES (
 JSON_ARRAY(
 'per_day_charge',
 'per_km_charge',
 'per_hour_charge'
 )
);

ALTER TABLE `users`
ADD COLUMN `vehicle_type_id` BIGINT UNSIGNED NULL AFTER `gear_type`,
ADD CONSTRAINT `users_vehicle_type_id_foreign`
FOREIGN KEY (`vehicle_type_id`)
REFERENCES `vehicle_types`(`id`)
ON DELETE CASCADE;

ALTER TABLE `users` CHANGE `gear_type` `gear_type` VARCHAR(255) NULL DEFAULT NULL;

UPDATE `menu_items` SET `deleted_at` = NULL WHERE `menu_items`.`slug` = 'tx_service_finddriver';
UPDATE `menu_items` SET `deleted_at` = NULL WHERE `menu_items`.`slug` = 'tx_service_categories_finddriver';
UPDATE `menu_items` SET `deleted_at` = NULL WHERE `menu_items`.`slug` = 'tx_service_categories_vehicle_finddriver';

ALTER TABLE `users` CHANGE `gear_type` `gear_type` VARCHAR(100) NULL DEFAULT NULL;

/*
=====================================================
//  shared ride //
=====================================================
*/

ALTER TABLE `users` ADD `ride_type` VARCHAR(100) NOT NULL AFTER `price_type`;

ALTER TABLE `ride_requests` ADD `ride_type` VARCHAR(100) NOT NULL AFTER `rental_vehicle_id`;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('116', '6');

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('117', '6');

ALTER TABLE `payment_accounts` CHANGE `ifsc` `ifsc` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

/*
=====================================================
//  shared ride //
=====================================================
*/















/*
=====================================================

//  shared ride //
=====================================================
*/