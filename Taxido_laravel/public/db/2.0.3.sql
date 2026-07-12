-- =========================================
-- FIND DRIVER SERVICE SQL
-- =========================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/* ================================
   1. UPDATE ENUM TYPE
================================ */

ALTER TABLE `services`
CHANGE `type` `type`
ENUM('cab','parcel','freight','ambulance','finddriver')
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci
NULL DEFAULT 'cab';



/* ================================
   2. INSERT SERVICE
================================ */

INSERT INTO `services`
(`id`, `name`, `slug`, `description`,
 `service_image_id`, `service_icon_id`,
 `type`, `status`, `is_primary`,
 `created_by_id`, `created_at`,
 `updated_at`, `deleted_at`)
VALUES (
    5,
    '{"en":"Find Driver","ar":"العثور على سائق","fr":"trouver un chauffeur","de":"Treiber finden","es":"Encontrar conductora"}',
    'find-driver',
    '{"en":"Hire a professional and reliable driver","ar":"استأجر سائقًا محترفًا وموثوقًا","fr":"Embauchez un chauffeur professionnel et fiable","de":"Engagieren Sie einen professionellen und zuverlässigen Fahrer"}',
    12,
    12,
    'finddriver',
    1,
    0,
    1,
    '2026-01-12 12:55:14',
    NULL,
    NULL
);



/* ================================
   3. INSERT SERVICE CATEGORIES
================================ */

INSERT INTO `service_categories`
(`id`, `name`, `slug`, `type`,
 `service_id`, `description`,
 `service_category_image_id`,
 `status`, `created_by_id`,
 `created_at`, `updated_at`, `deleted_at`)
VALUES

(12,
 '{"en":"One Way","ar":"طريقة واحدة","fr":"Sens Unique","de":"Ein Weg","es":"Un camino"}',
 'oneway',
 'oneway',
 5,
 'One Way',
 1,
 1,
 33,
 '2026-01-12 10:07:42',
 NULL,
 NULL
),

(13,
 '{"en":"Round Trip","ar":"ذهابا وإيابا","fr":"aller-retour","de":"Rundfahrt","es":"ida y vuelta"}',
 'roundtrip',
 'roundtrip',
 5,
 'roundtrip',
 2,
 1,
 1,
 '2026-01-12 10:13:49',
 NULL,
 NULL
),

(14,
 '{"en":"Outstation","ar":"محطة خارجية","fr":"station éloignée","de":"Außenstation","es":"estación avanzada"}',
 'outstation',
 'outstation',
 5,
 'outstation',
 1,
 1,
 38,
 '2026-01-12 10:21:35',
 NULL,
 NULL
),

(15,
 '{"en":"Daily","ar":"يوميًا","fr":"tous les jours","de":"täglich","es":"Diario"}',
 'daily',
 'daily',
 5,
 'daily',
 1,
 1,
 1,
 '2026-01-12 10:25:10',
 NULL,
 NULL
);



/* ================================
   4. INSERT PIVOT TABLE
================================ */

INSERT INTO `categories_services`
(`id`, `service_category_id`, `service_id`,
 `created_at`, `updated_at`, `deleted_at`)
VALUES

(9, 12, 5, '2026-01-12 11:49:09', NULL, NULL),
(10, 15, 5, NULL, NULL, NULL),
(11, 14, 5, NULL, NULL, NULL),
(12, 13, 5, NULL, NULL, NULL);



/* ================================
   5. UPDATE USER SERVICE
================================ */

UPDATE users
SET service_id = 5,
    service_category_id = 12
WHERE id = 4;



/* ================================
   6. ADD DRIVER FIELDS
================================ */

ALTER TABLE users
ADD COLUMN experience INT NULL,
ADD COLUMN driver_charge INT NULL;



COMMIT;
