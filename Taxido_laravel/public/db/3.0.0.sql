-- ============================================================
-- Taxido v3.0 - Updates & Chat & Coupon System
-- FULL COMPATIBLE VERSION
-- Supports:
--   ✔ MySQL 5.7
--   ✔ MySQL 8+
--   ✔ phpMyAdmin
--   ✔ Re-run safe
-- ============================================================


/*==============================================================
= 1. notification_logs
==============================================================*/
CREATE TABLE IF NOT EXISTS `notification_logs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT DEFAULT NULL,
    `notification_type` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `template_slug` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `placeholders` JSON DEFAULT NULL,
    `status` ENUM('pending','sent','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
    `error_message` TEXT COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `retry_count` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,

    PRIMARY KEY (`id`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


/*==============================================================
= 2. driver_locations
==============================================================*/
CREATE TABLE IF NOT EXISTS `driver_locations` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `driver_id` BIGINT UNSIGNED NOT NULL,
    `lat` DECIMAL(10,7) NOT NULL DEFAULT 0,
    `lng` DECIMAL(10,7) NOT NULL DEFAULT 0,
    `is_online` TINYINT(1) NOT NULL DEFAULT 0,
    `is_on_ride` TINYINT(1) NOT NULL DEFAULT 0,
    `is_verified` TINYINT(1) NOT NULL DEFAULT 0,
    `service_id` BIGINT UNSIGNED DEFAULT NULL,
    `service_category_id` BIGINT UNSIGNED DEFAULT NULL,
    `vehicle_type_id` BIGINT UNSIGNED DEFAULT NULL,
    `fleet_manager_id` BIGINT UNSIGNED DEFAULT NULL,
    `last_online_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_driver_locations_driver` (`driver_id`),
    KEY `idx_driver_locations_online` (`is_online`),
    KEY `idx_driver_locations_on_ride` (`is_on_ride`),
    KEY `idx_driver_locations_latLng` (`lat`, `lng`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


/*==============================================================
= 3. ride_requests columns
==============================================================*/

-- ------------------------------------------------------------
-- bid_extra_amount
-- ------------------------------------------------------------
SET @exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'ride_requests'
    AND COLUMN_NAME = 'bid_extra_amount'
);

SET @sql = IF(
    @exists = 0,
    'ALTER TABLE `ride_requests`
        ADD COLUMN `bid_extra_amount` DOUBLE NULL
        AFTER `commission`',
    'SELECT "bid_extra_amount already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- ------------------------------------------------------------
-- ride_type
-- ------------------------------------------------------------
SET @exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'ride_requests'
    AND COLUMN_NAME = 'ride_type'
);

SET @sql = IF(
    @exists = 0,
    'ALTER TABLE `ride_requests`
        ADD COLUMN `ride_type` VARCHAR(20)
        DEFAULT "instant"
        COMMENT "instant | bidding"
        AFTER `driver_id`',
    'SELECT "ride_type already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- ------------------------------------------------------------
-- current_driver_id
-- ------------------------------------------------------------
SET @exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'ride_requests'
    AND COLUMN_NAME = 'current_driver_id'
);

SET @sql = IF(
    @exists = 0,
    'ALTER TABLE `ride_requests`
        ADD COLUMN `current_driver_id`
        BIGINT UNSIGNED NULL DEFAULT NULL
        COMMENT "Currently assigned driver"',
    'SELECT "current_driver_id already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- ------------------------------------------------------------
-- rejected_driver_ids
-- ------------------------------------------------------------
SET @exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'ride_requests'
    AND COLUMN_NAME = 'rejected_driver_ids'
);

SET @sql = IF(
    @exists = 0,
    'ALTER TABLE `ride_requests`
        ADD COLUMN `rejected_driver_ids`
        JSON NULL DEFAULT NULL
        COMMENT "Rejected driver IDs"',
    'SELECT "rejected_driver_ids already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- ------------------------------------------------------------
-- driver_acceptance_expires_at
-- ------------------------------------------------------------
SET @exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'ride_requests'
    AND COLUMN_NAME = 'driver_acceptance_expires_at'
);

SET @sql = IF(
    @exists = 0,
    'ALTER TABLE `ride_requests`
        ADD COLUMN `driver_acceptance_expires_at`
        TIMESTAMP NULL DEFAULT NULL',
    'SELECT "driver_acceptance_expires_at already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- ------------------------------------------------------------
-- find_driver_expires_at
-- ------------------------------------------------------------
SET @exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'ride_requests'
    AND COLUMN_NAME = 'find_driver_expires_at'
);

SET @sql = IF(
    @exists = 0,
    'ALTER TABLE `ride_requests`
        ADD COLUMN `find_driver_expires_at`
        TIMESTAMP NULL DEFAULT NULL',
    'SELECT "find_driver_expires_at already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


/*==============================================================
= 4. Foreign Key
==============================================================*/
SET @fk_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'ride_requests'
    AND CONSTRAINT_NAME = 'ride_requests_current_driver_id_foreign'
);

SET @sql = IF(
    @fk_exists = 0,
    'ALTER TABLE `ride_requests`
        ADD CONSTRAINT `ride_requests_current_driver_id_foreign`
        FOREIGN KEY (`current_driver_id`)
        REFERENCES `users`(`id`)
        ON DELETE SET NULL',
    'SELECT "Foreign key already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


/*==============================================================
= 5. peak_zones
==============================================================*/
SET @exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'peak_zones'
    AND COLUMN_NAME = 'distance_price_percentage'
);

SET @sql = IF(
    @exists = 0,
    'ALTER TABLE `peak_zones`
        ADD COLUMN `distance_price_percentage`
        DOUBLE DEFAULT 0
        AFTER `is_active`',
    'SELECT "distance_price_percentage already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


/*==============================================================
= 6. chat_rooms
==============================================================*/
CREATE TABLE IF NOT EXISTS `chat_rooms` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `room_id` VARCHAR(255) NOT NULL,
    `participants` JSON DEFAULT NULL,
    `last_message` JSON DEFAULT NULL,
    `unread_count` JSON DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `chat_rooms_room_id_unique` (`room_id`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


/*==============================================================
= 7. chat_messages
==============================================================*/
CREATE TABLE IF NOT EXISTS `chat_messages` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `room_id` VARCHAR(255) NOT NULL,
    `sender_id` BIGINT UNSIGNED NOT NULL,
    `receiver_id` BIGINT UNSIGNED NOT NULL,
    `sender_name` VARCHAR(255) DEFAULT NULL,
    `receiver_name` VARCHAR(255) DEFAULT NULL,
    `message` TEXT DEFAULT NULL,
    `images` JSON DEFAULT NULL,
    `is_read` TINYINT(1) NOT NULL DEFAULT 0,
    `cleared_by` JSON DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,

    PRIMARY KEY (`id`),
    KEY `chat_messages_room_id_index` (`room_id`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


/*==============================================================
= 8. coupon_zones
==============================================================*/
CREATE TABLE IF NOT EXISTS `coupon_zones` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `coupon_id` BIGINT UNSIGNED DEFAULT NULL,
    `zone_id` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,

    PRIMARY KEY (`id`),

    CONSTRAINT `coupon_zones_coupon_id_foreign`
    FOREIGN KEY (`coupon_id`)
    REFERENCES `coupons`(`id`)
    ON DELETE CASCADE,

    CONSTRAINT `coupon_zones_zone_id_foreign`
    FOREIGN KEY (`zone_id`)
    REFERENCES `zones`(`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `taxido_settings` CHANGE `taxido_values` `cabbooking_values` JSON NULL DEFAULT NULL;
