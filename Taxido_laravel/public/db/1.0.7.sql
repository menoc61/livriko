ALTER TABLE driver_documents DROP COLUMN fleet_manager_id;

CREATE TABLE `fleet_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `fleet_manager_id` bigint UNSIGNED DEFAULT NULL,
  `document_id` bigint UNSIGNED DEFAULT NULL,
  `document_image_id` bigint UNSIGNED DEFAULT NULL,
  `expired_at` date DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--
--
-- Indexes for table `fleet_documents`
--
ALTER TABLE `fleet_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fleet_documents_fleet_manager_id_foreign` (`fleet_manager_id`),
  ADD KEY `fleet_documents_document_id_foreign` (`document_id`),
  ADD KEY `fleet_documents_document_image_id_foreign` (`document_image_id`),
  ADD KEY `fleet_documents_created_by_id_foreign` (`created_by_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fleet_documents`
--
ALTER TABLE `fleet_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fleet_documents`
--
ALTER TABLE `fleet_documents`
  ADD CONSTRAINT `fleet_documents_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fleet_documents_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fleet_documents_document_image_id_foreign` FOREIGN KEY (`document_image_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fleet_documents_fleet_manager_id_foreign` FOREIGN KEY (`fleet_manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;


ALTER TABLE `push_notifications` ADD `is_scheduled` INT NULL AFTER `created_by_id`, ADD `scheduled_at` TIMESTAMP NULL AFTER `is_scheduled`, ADD `delivered_at` TIMESTAMP NULL AFTER `scheduled_at`;

ALTER TABLE `payment_accounts` ADD `default` ENUM('bank','paypal') NULL DEFAULT 'bank' AFTER `status`;
