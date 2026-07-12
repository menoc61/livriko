SET FOREIGN_KEY_CHECKS=0;
DELETE FROM `model_has_roles`;
DELETE FROM `model_has_permissions`;
DELETE FROM `role_has_permissions`;
DELETE FROM `permissions`;
DELETE FROM `roles`;
DELETE FROM `modules`;
DELETE FROM `menu_items`;
DELETE FROM `migrations`;

ALTER TABLE `model_has_roles` AUTO_INCREMENT = 1;
ALTER TABLE `model_has_permissions` AUTO_INCREMENT = 1;
ALTER TABLE `role_has_permissions` AUTO_INCREMENT = 1;
ALTER TABLE `permissions` AUTO_INCREMENT = 1;
ALTER TABLE `roles` AUTO_INCREMENT = 1;
ALTER TABLE `modules` AUTO_INCREMENT = 1;
ALTER TABLE `menu_items` AUTO_INCREMENT = 1;
ALTER TABLE `menu_items` CHANGE `badgeable` `badgeable` TINYINT(1) NULL DEFAULT '0';
ALTER TABLE `menu_items` CHANGE `badge` `badge` INT NULL DEFAULT '0';
ALTER TABLE `migrations` AUTO_INCREMENT = 1;

ALTER TABLE `service_categories` ADD `type` VARCHAR(255) NULL AFTER `slug`;
ALTER TABLE `service_categories` ADD `service_id` VARCHAR(255) NULL AFTER `type`;
ALTER TABLE `vehicle_types` ADD `service_id` INT NULL AFTER `name`;
ALTER TABLE `vehicle_types` ADD `service_category_id` INT NULL AFTER `service_id`;

INSERT INTO `modules` (`id`, `name`, `actions`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'media', '{\"index\":\"media.index\",\"create\":\"media.create\",\"edit\":\"media.edit\",\"trash\":\"media.destroy\",\"restore\":\"media.restore\",\"delete\":\"media.forceDelete\"}', '2025-04-26 01:49:39', '2025-04-26 01:49:39', NULL),
(2, 'users', '{\"index\":\"user.index\",\"create\":\"user.create\",\"edit\":\"user.edit\",\"trash\":\"user.destroy\",\"restore\":\"user.restore\",\"delete\":\"user.forceDelete\"}', '2025-04-26 01:49:39', '2025-04-26 01:49:39', NULL),
(3, 'roles', '{\"index\":\"role.index\",\"create\":\"role.create\",\"edit\":\"role.edit\",\"delete\":\"role.destroy\"}', '2025-04-26 01:49:39', '2025-04-26 01:49:39', NULL),
(4, 'attachments', '{\"index\":\"attachment.index\",\"create\":\"attachment.create\",\"delete\":\"attachment.destroy\",\"edit\":\"attachment.edit\"}', '2025-04-26 01:49:39', '2025-04-26 01:49:39', NULL),
(5, 'categories', '{\"index\":\"category.index\",\"create\":\"category.create\",\"edit\":\"category.edit\",\"delete\":\"category.destroy\"}', '2025-04-26 01:49:39', '2025-04-26 01:49:39', NULL),
(6, 'tags', '{\"index\":\"tag.index\",\"create\":\"tag.create\",\"edit\":\"tag.edit\",\"trash\":\"tag.destroy\",\"restore\":\"tag.restore\",\"delete\":\"tag.forceDelete\"}', '2025-04-26 01:49:39', '2025-04-26 01:49:39', NULL),
(7, 'blogs', '{\"index\":\"blog.index\",\"create\":\"blog.create\",\"edit\":\"blog.edit\",\"trash\":\"blog.destroy\",\"restore\":\"blog.restore\",\"delete\":\"blog.forceDelete\"}', '2025-04-26 01:49:40', '2025-04-26 01:49:40', NULL),
(8, 'pages', '{\"index\":\"page.index\",\"create\":\"page.create\",\"edit\":\"page.edit\",\"trash\":\"page.destroy\",\"restore\":\"page.restore\",\"delete\":\"page.forceDelete\"}', '2025-04-26 01:49:40', '2025-04-26 01:49:40', NULL),
(9, 'testimonials', '{\"index\":\"testimonial.index\",\"create\":\"testimonial.create\",\"edit\":\"testimonial.edit\",\"trash\":\"testimonial.destroy\",\"restore\":\"testimonial.restore\",\"delete\":\"testimonial.forceDelete\"}', '2025-04-26 01:49:40', '2025-04-26 01:49:40', NULL),
(10, 'taxes', '{\"index\":\"tax.index\",\"create\":\"tax.create\",\"edit\":\"tax.edit\",\"trash\":\"tax.destroy\",\"restore\":\"tax.restore\",\"delete\":\"tax.forceDelete\"}', '2025-04-26 01:49:40', '2025-04-26 01:49:40', NULL),
(11, 'currencies', '{\"index\":\"currency.index\",\"create\":\"currency.create\",\"edit\":\"currency.edit\",\"trash\":\"currency.destroy\",\"restore\":\"currency.restore\",\"delete\":\"currency.forceDelete\"}', '2025-04-26 01:49:40', '2025-04-26 01:49:40', NULL),
(12, 'languages', '{\"index\":\"language.index\",\"create\":\"language.create\",\"edit\":\"language.edit\",\"trash\":\"language.destroy\",\"restore\":\"language.restore\",\"delete\":\"language.forceDelete\"}', '2025-04-26 01:49:40', '2025-04-26 01:49:40', NULL),
(13, 'settings', '{\"index\":\"ticket.setting.index\",\"create\":\"ticket.setting.create\",\"edit\":\"ticket.setting.edit\",\"trash\":\"ticket.setting.destroy\",\"restore\":\"ticket.setting.restore\",\"delete\":\"ticket.setting.forceDelete\"}', '2025-04-26 01:49:41', '2025-04-26 01:50:10', NULL),
(14, 'system-tools', '{\"index\":\"system-tool.index\",\"create\":\"system-tool.create\",\"edit\":\"system-tool.edit\",\"trash\":\"system-tool.destroy\",\"restore\":\"system-tool.restore\",\"delete\":\"system-tool.forceDelete\"}', '2025-04-26 01:49:41', '2025-04-26 01:49:41', NULL),
(15, 'plugins', '{\"index\":\"plugin.index\",\"create\":\"plugin.create\",\"edit\":\"plugin.edit\",\"trash\":\"plugin.destroy\",\"restore\":\"plugin.restore\",\"delete\":\"plugin.forceDelete\"}', '2025-04-26 01:49:41', '2025-04-26 01:49:41', NULL),
(16, 'about-system', '{\"index\":\"about-system.index\"}', '2025-04-26 01:49:41', '2025-04-26 01:49:41', NULL),
(17, 'payment-methods', '{\"index\":\"payment-method.index\",\"edit\":\"payment-method.edit\"}', '2025-04-26 01:49:41', '2025-04-26 01:49:41', NULL),
(18, 'sms-gateways', '{\"index\":\"sms-gateway.index\",\"edit\":\"sms-gateway.edit\"}', '2025-04-26 01:49:41', '2025-04-26 01:49:41', NULL),
(19, 'landing_page', '{\"index\":\"landing_page.index\",\"edit\":\"landing_page.edit\"}', '2025-04-26 01:49:41', '2025-04-26 01:49:41', NULL),
(20, 'appearance', '{\"index\":\"appearance.index\",\"edit\":\"appearance.edit\",\"create\":\"appearance.create\"}', '2025-04-26 01:49:41', '2025-04-26 01:49:41', NULL),
(21, 'backups', '{\"index\":\"backup.index\",\"create\":\"backup.create\",\"edit\":\"backup.edit\",\"trash\":\"backup.destroy\",\"restore\":\"backup.restore\",\"delete\":\"backup.forceDelete\"}', '2025-04-26 01:49:41', '2025-04-26 01:49:41', NULL),

(23, 'drivers', '{\"index\":\"driver.index\",\"create\":\"driver.create\",\"edit\":\"driver.edit\",\"trash\":\"driver.destroy\",\"restore\":\"driver.restore\",\"delete\":\"driver.forceDelete\"}', '2025-04-26 01:49:55', '2025-04-26 01:49:55', NULL),
(24, 'dispatchers', '{\"index\":\"dispatcher.index\",\"create\":\"dispatcher.create\",\"edit\":\"dispatcher.edit\",\"trash\":\"dispatcher.destroy\",\"restore\":\"dispatcher.restore\",\"delete\":\"dispatcher.forceDelete\"}', '2025-04-26 01:49:55', '2025-04-26 01:49:55', NULL),
(25, 'unverified_drivers', '{\"index\":\"unverified_driver.index\",\"create\":\"unverified_driver.create\",\"edit\":\"unverified_driver.edit\",\"trash\":\"unverified_driver.destroy\",\"restore\":\"unverified_driver.restore\",\"delete\":\"unverified_driver.forceDelete\"}', '2025-04-26 01:49:55', '2025-04-26 01:49:55', NULL),
(26, 'banners', '{\"index\":\"banner.index\",\"create\":\"banner.create\",\"edit\":\"banner.edit\",\"trash\":\"banner.destroy\",\"restore\":\"banner.restore\",\"delete\":\"banner.forceDelete\"}', '2025-04-26 01:49:55', '2025-04-26 01:49:55', NULL),
(27, 'documents', '{\"index\":\"document.index\",\"create\":\"document.create\",\"edit\":\"document.edit\",\"trash\":\"document.destroy\",\"restore\":\"document.restore\",\"delete\":\"document.forceDelete\"}', '2025-04-26 01:49:55', '2025-04-26 01:49:55', NULL),
(28, 'vehicle_types', '{\"index\":\"vehicle_type.index\",\"create\":\"vehicle_type.create\",\"edit\":\"vehicle_type.edit\",\"trash\":\"vehicle_type.destroy\",\"restore\":\"vehicle_type.restore\",\"delete\":\"vehicle_type.forceDelete\"}', '2025-04-26 01:49:55', '2025-04-26 01:49:55', NULL),
(29, 'coupons', '{\"index\":\"coupon.index\",\"create\":\"coupon.create\",\"edit\":\"coupon.edit\",\"trash\":\"coupon.destroy\",\"restore\":\"coupon.restore\",\"delete\":\"coupon.forceDelete\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(30, 'zones', '{\"index\":\"zone.index\",\"create\":\"zone.create\",\"edit\":\"zone.edit\",\"trash\":\"zone.destroy\",\"restore\":\"zone.restore\",\"delete\":\"zone.forceDelete\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(31, 'faqs', '{\"index\":\"faq.index\",\"create\":\"faq.create\",\"edit\":\"faq.edit\",\"trash\":\"faq.destroy\",\"restore\":\"faq.restore\",\"delete\":\"faq.forceDelete\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(32, 'heatmaps', '{\"index\":\"heat_map.index\",\"create\":\"heat_map.create\",\"edit\":\"heat_map.edit\",\"trash\":\"heat_map.destroy\",\"restore\":\"heat_map.restore\",\"delete\":\"heat_map.forceDelete\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(33, 'soses', '{\"index\":\"sos.index\",\"create\":\"sos.create\",\"edit\":\"sos.edit\",\"trash\":\"sos.destroy\",\"restore\":\"sos.restore\",\"delete\":\"sos.forceDelete\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(34, 'driver_documents', '{\"index\":\"driver_document.index\",\"create\":\"driver_document.create\",\"edit\":\"driver_document.edit\",\"trash\":\"driver_document.destroy\",\"restore\":\"driver_document.restore\",\"delete\":\"driver_document.forceDelete\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(35, 'driver_rules', '{\"index\":\"driver_rule.index\",\"create\":\"driver_rule.create\",\"edit\":\"driver_rule.edit\",\"trash\":\"driver_rule.destroy\",\"restore\":\"driver_rule.restore\",\"delete\":\"driver_rule.forceDelete\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(36, 'cab_commission_histories', '{\"index\":\"cab_commission_history.index\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(37, 'notices', '{\"index\":\"notice.index\",\"create\":\"notice.create\",\"edit\":\"notice.edit\",\"trash\":\"notice.destroy\",\"restore\":\"notice.restore\",\"delete\":\"notice.forceDelete\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(38, 'driver_wallets', '{\"index\":\"driver_wallet.index\",\"credit\":\"driver_wallet.credit\",\"debit\":\"driver_wallet.debit\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(39, 'services', '{\"index\":\"service.index\",\"edit\":\"service.edit\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(40, 'onboardings', '{\"index\":\"onboarding.index\",\"edit\":\"onboarding.edit\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(41, 'service_categories', '{\"index\":\"service_category.index\",\"edit\":\"service_category.edit\"}', '2025-04-26 01:49:56', '2025-04-26 01:49:56', NULL),
(42, 'taxido_settings', '{\"index\":\"taxido_setting.index\",\"edit\":\"taxido_setting.edit\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(43, 'ride_request', '{\"index\":\"ride_request.index\",\"create\":\"ride_request.create\",\"edit\":\"ride_request.edit\",\"trash\":\"ride_request.destroy\",\"restore\":\"ride_request.restore\",\"delete\":\"ride_request.forceDelete\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(44, 'rides', '{\"index\":\"ride.index\",\"create\":\"ride.create\",\"edit\":\"ride.edit\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(45, 'plans', '{\"index\":\"plan.index\",\"create\":\"plan.create\",\"edit\":\"plan.edit\",\"trash\":\"plan.destroy\",\"restore\":\"plan.restore\",\"delete\":\"plan.forceDelete\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(46, 'subscriptions', '{\"index\":\"subscription.index\",\"create\":\"subscription.create\",\"edit\":\"subscription.edit\",\"destroy\":\"subscription.destroy\",\"purchase\":\"subscription.purchase\",\"cancel\":\"subscription.cancel\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(47, 'bids', '{\"index\":\"bid.index\",\"create\":\"bid.create\",\"edit\":\"bid.edit\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(48, 'push_notifications', '{\"index\":\"push_notification.index\",\"create\":\"push_notification.create\",\"trash\":\"push_notification.destroy\",\"delete\":\"push_notification.forceDelete\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(49, 'rider_wallets', '{\"index\":\"rider_wallet.index\",\"credit\":\"rider_wallet.credit\",\"debit\":\"rider_wallet.debit\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(50, 'withdraw_requests', '{\"index\":\"withdraw_request.index\",\"create\":\"withdraw_request.create\",\"edit\":\"withdraw_request.edit\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(51, 'fleet_withdraw_requests', '{\"index\":\"fleet_withdraw_request.index\",\"create\":\"fleet_withdraw_request.create\",\"edit\":\"fleet_withdraw_request.edit\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(52, 'reports', '{\"index\":\"report.index\",\"create\":\"report.create\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(53, 'driver_locations', '{\"index\":\"driver_location.index\",\"create\":\"driver_location.create\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(54, 'cancellation_reasons', '{\"index\":\"cancellation_reason.index\",\"create\":\"cancellation_reason.create\",\"edit\":\"cancellation_reason.edit\",\"trash\":\"cancellation_reason.destroy\",\"restore\":\"cancellation_reason.restore\",\"delete\":\"cancellation_reason.forceDelete\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(55, 'driver_reviews', '{\"index\":\"driver_review.index\",\"create\":\"driver_review.create\",\"trash\":\"driver_review.destroy\",\"restore\":\"driver_review.restore\",\"delete\":\"driver_review.forceDelete\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(56, 'rider_reviews', '{\"index\":\"rider_review.index\",\"create\":\"rider_review.create\",\"trash\":\"rider_review.destroy\",\"restore\":\"rider_review.restore\",\"delete\":\"rider_review.forceDelete\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(57, 'hourly_packages', '{\"index\":\"hourly_package.index\",\"create\":\"hourly_package.create\",\"edit\":\"hourly_package.edit\",\"trash\":\"hourly_package.destroy\",\"restore\":\"hourly_package.restore\",\"delete\":\"hourly_package.forceDelete\"}', '2025-04-26 01:49:57', '2025-04-26 01:49:57', NULL),
(58, 'sos_alerts', '{\"index\":\"sos_alert.index\",\"create\":\"sos_alert.create\",\"edit\":\"sos_alert.edit\",\"trash\":\"sos_alert.destroy\",\"restore\":\"sos_alert.restore\",\"delete\":\"sos_alert.forceDelete\"}', '2025-04-26 01:49:58', '2025-04-26 01:49:58', NULL),
(59, 'rental_vehicles', '{\"index\":\"rental_vehicle.index\",\"create\":\"rental_vehicle.create\",\"edit\":\"rental_vehicle.edit\",\"trash\":\"rental_vehicle.destroy\",\"restore\":\"rental_vehicle.restore\",\"delete\":\"rental_vehicle.forceDelete\"}', '2025-04-26 01:49:58', '2025-04-26 01:49:58', NULL),
(60, 'fleet_managers', '{\"index\":\"fleet_manager.index\",\"create\":\"fleet_manager.create\",\"edit\":\"fleet_manager.edit\",\"trash\":\"fleet_manager.destroy\",\"restore\":\"fleet_manager.restore\",\"delete\":\"fleet_manager.forceDelete\"}', '2025-04-26 01:49:58', '2025-04-26 01:49:58', NULL),
(61, 'fleet_wallets', '{\"index\":\"fleet_wallet.index\",\"credit\":\"fleet_wallet.credit\",\"debit\":\"fleet_wallet.debit\"}', '2025-04-26 01:49:58', '2025-04-26 01:49:58', NULL),
(62, 'tickets', '{\"index\":\"ticket.ticket.index\",\"create\":\"ticket.ticket.create\",\"reply\":\"ticket.ticket.reply\",\"trash\":\"ticket.ticket.destroy\",\"restore\":\"ticket.ticket.restore\",\"delete\":\"ticket.ticket.forceDelete\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL),
(63, 'priorities', '{\"index\":\"ticket.priority.index\",\"create\":\"ticket.priority.create\",\"edit\":\"ticket.priority.edit\",\"trash\":\"ticket.priority.destroy\",\"restore\":\"ticket.priority.restore\",\"delete\":\"ticket.priority.forceDelete\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL),
(64, 'executives', '{\"index\":\"ticket.executive.index\",\"create\":\"ticket.executive.create\",\"edit\":\"ticket.executive.edit\",\"trash\":\"ticket.executive.destroy\",\"restore\":\"ticket.executive.restore\",\"delete\":\"ticket.executive.forceDelete\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL),
(65, 'departments', '{\"index\":\"ticket.department.index\",\"create\":\"ticket.department.create\",\"edit\":\"ticket.department.edit\",\"show\":\"ticket.department.show\",\"trash\":\"ticket.department.destroy\",\"restore\":\"ticket.department.restore\",\"delete\":\"ticket.department.forceDelete\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL),
(66, 'formfields', '{\"index\":\"ticket.formfield.index\",\"create\":\"ticket.formfield.create\",\"edit\":\"ticket.formfield.edit\",\"trash\":\"ticket.formfield.destroy\",\"restore\":\"ticket.formfield.restore\",\"delete\":\"ticket.formfield.forceDelete\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL),
(67, 'statuses', '{\"index\":\"ticket.status.index\",\"create\":\"ticket.status.create\",\"edit\":\"ticket.status.edit\",\"trash\":\"ticket.status.destroy\",\"restore\":\"ticket.status.restore\",\"delete\":\"ticket.status.forceDelete\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL),
(68, 'knowledge', '{\"index\":\"ticket.knowledge.index\",\"create\":\"ticket.knowledge.create\",\"edit\":\"ticket.knowledge.edit\",\"trash\":\"ticket.knowledge.destroy\",\"restore\":\"ticket.knowledge.restore\",\"delete\":\"ticket.knowledge.forceDelete\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL),
(69, 'knowledge_categories', '{\"index\":\"ticket.category.index\",\"create\":\"ticket.category.create\",\"edit\":\"ticket.category.edit\",\"delete\":\"ticket.category.destroy\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL),
(70, 'knowledge_tags', '{\"index\":\"ticket.tag.index\",\"create\":\"ticket.tag.create\",\"edit\":\"ticket.tag.edit\",\"trash\":\"ticket.tag.destroy\",\"restore\":\"ticket.tag.restore\",\"delete\":\"ticket.tag.forceDelete\"}', '2025-04-26 01:50:10', '2025-04-26 01:50:10', NULL);

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'media.index', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(2, 'media.create', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(3, 'media.edit', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(4, 'media.destroy', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(5, 'media.restore', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(6, 'media.forceDelete', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(7, 'user.index', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(8, 'user.create', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(9, 'user.edit', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(10, 'user.destroy', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(11, 'user.restore', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(12, 'user.forceDelete', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(13, 'role.index', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(14, 'role.create', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(15, 'role.edit', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(16, 'role.destroy', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(17, 'attachment.index', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(18, 'attachment.create', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(19, 'attachment.destroy', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(20, 'attachment.edit', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(21, 'category.index', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(22, 'category.create', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(23, 'category.edit', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(24, 'category.destroy', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(25, 'tag.index', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(26, 'tag.create', 'web', '2025-04-26 01:49:39', '2025-04-26 01:49:39'),
(27, 'tag.edit', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(28, 'tag.destroy', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(29, 'tag.restore', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(30, 'tag.forceDelete', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(31, 'blog.index', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(32, 'blog.create', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(33, 'blog.edit', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(34, 'blog.destroy', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(35, 'blog.restore', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(36, 'blog.forceDelete', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(37, 'page.index', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(38, 'page.create', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(39, 'page.edit', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(40, 'page.destroy', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(41, 'page.restore', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(42, 'page.forceDelete', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(43, 'testimonial.index', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(44, 'testimonial.create', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(45, 'testimonial.edit', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(46, 'testimonial.destroy', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(47, 'testimonial.restore', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(48, 'testimonial.forceDelete', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(49, 'tax.index', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(50, 'tax.create', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(51, 'tax.edit', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(52, 'tax.destroy', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(53, 'tax.restore', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(54, 'tax.forceDelete', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(55, 'currency.index', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(56, 'currency.create', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(57, 'currency.edit', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(58, 'currency.destroy', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(59, 'currency.restore', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(60, 'currency.forceDelete', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(61, 'language.index', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(62, 'language.create', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(63, 'language.edit', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(64, 'language.destroy', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(65, 'language.restore', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(66, 'language.forceDelete', 'web', '2025-04-26 01:49:40', '2025-04-26 01:49:40'),
(67, 'setting.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(68, 'setting.edit', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(69, 'system-tool.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(70, 'system-tool.create', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(71, 'system-tool.edit', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(72, 'system-tool.destroy', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(73, 'system-tool.restore', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(74, 'system-tool.forceDelete', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(75, 'plugin.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(76, 'plugin.create', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(77, 'plugin.edit', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(78, 'plugin.destroy', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(79, 'plugin.restore', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(80, 'plugin.forceDelete', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(81, 'about-system.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(82, 'payment-method.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(83, 'payment-method.edit', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(84, 'sms-gateway.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(85, 'sms-gateway.edit', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(86, 'landing_page.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(87, 'landing_page.edit', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(88, 'appearance.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(89, 'appearance.edit', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(90, 'appearance.create', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(91, 'backup.index', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(92, 'backup.create', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(93, 'backup.edit', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(94, 'backup.destroy', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(95, 'backup.restore', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(96, 'backup.forceDelete', 'web', '2025-04-26 01:49:41', '2025-04-26 01:49:41'),
(98, 'rider.create', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(99, 'rider.edit', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(100, 'rider.destroy', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(101, 'rider.restore', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(102, 'rider.forceDelete', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(103, 'driver.index', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(104, 'driver.create', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(105, 'driver.edit', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(106, 'driver.destroy', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(107, 'driver.restore', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(108, 'driver.forceDelete', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(109, 'dispatcher.index', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(110, 'dispatcher.create', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(111, 'dispatcher.edit', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(112, 'dispatcher.destroy', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(113, 'dispatcher.restore', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(114, 'dispatcher.forceDelete', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(115, 'unverified_driver.index', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(116, 'unverified_driver.create', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(117, 'unverified_driver.edit', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(118, 'unverified_driver.destroy', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(119, 'unverified_driver.restore', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(120, 'unverified_driver.forceDelete', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(121, 'banner.index', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(122, 'banner.create', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(123, 'banner.edit', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(124, 'banner.destroy', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(125, 'banner.restore', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(126, 'banner.forceDelete', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(127, 'document.index', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(128, 'document.create', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(129, 'document.edit', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(130, 'document.destroy', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(131, 'document.restore', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(132, 'document.forceDelete', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(133, 'vehicle_type.index', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(134, 'vehicle_type.create', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(135, 'vehicle_type.edit', 'web', '2025-04-26 01:49:55', '2025-04-26 01:49:55'),
(136, 'vehicle_type.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(137, 'vehicle_type.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(138, 'vehicle_type.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(139, 'coupon.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(140, 'coupon.create', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(141, 'coupon.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(142, 'coupon.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(143, 'coupon.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(144, 'coupon.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(145, 'zone.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(146, 'zone.create', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(147, 'zone.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(148, 'zone.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(149, 'zone.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(150, 'zone.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(151, 'faq.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(152, 'faq.create', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(153, 'faq.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(154, 'faq.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(155, 'faq.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(156, 'faq.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(157, 'heat_map.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(158, 'heat_map.create', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(159, 'heat_map.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(160, 'heat_map.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(161, 'heat_map.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(162, 'heat_map.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(163, 'sos.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(164, 'sos.create', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(165, 'sos.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(166, 'sos.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(167, 'sos.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(168, 'sos.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(169, 'driver_document.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(170, 'driver_document.create', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(171, 'driver_document.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(172, 'driver_document.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(173, 'driver_document.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(174, 'driver_document.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(175, 'driver_rule.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(176, 'driver_rule.create', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(177, 'driver_rule.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(178, 'driver_rule.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(179, 'driver_rule.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(180, 'driver_rule.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(181, 'cab_commission_history.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(182, 'notice.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(183, 'notice.create', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(184, 'notice.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(185, 'notice.destroy', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(186, 'notice.restore', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(187, 'notice.forceDelete', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(188, 'driver_wallet.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(189, 'driver_wallet.credit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(190, 'driver_wallet.debit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(191, 'service.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(192, 'service.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(193, 'onboarding.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(194, 'onboarding.edit', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(195, 'service_category.index', 'web', '2025-04-26 01:49:56', '2025-04-26 01:49:56'),
(196, 'service_category.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(197, 'taxido_setting.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(198, 'taxido_setting.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(199, 'ride_request.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(200, 'ride_request.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(201, 'ride_request.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(202, 'ride_request.destroy', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(203, 'ride_request.restore', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(204, 'ride_request.forceDelete', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(205, 'ride.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(206, 'ride.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(207, 'ride.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(208, 'plan.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(209, 'plan.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(210, 'plan.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(211, 'plan.destroy', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(212, 'plan.restore', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(213, 'plan.forceDelete', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(214, 'subscription.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(215, 'subscription.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(216, 'subscription.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(217, 'subscription.destroy', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(218, 'subscription.purchase', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(219, 'subscription.cancel', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(220, 'bid.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(221, 'bid.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(222, 'bid.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(223, 'push_notification.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(224, 'push_notification.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(225, 'push_notification.destroy', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(226, 'push_notification.forceDelete', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(227, 'rider_wallet.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(228, 'rider_wallet.credit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(229, 'rider_wallet.debit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(230, 'withdraw_request.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(231, 'withdraw_request.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(232, 'withdraw_request.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(233, 'fleet_withdraw_request.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(234, 'fleet_withdraw_request.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(235, 'fleet_withdraw_request.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(236, 'report.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(237, 'report.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(238, 'driver_location.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(239, 'driver_location.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(240, 'cancellation_reason.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(241, 'cancellation_reason.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(242, 'cancellation_reason.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(243, 'cancellation_reason.destroy', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(244, 'cancellation_reason.restore', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(245, 'cancellation_reason.forceDelete', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(246, 'driver_review.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(247, 'driver_review.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(248, 'driver_review.destroy', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(249, 'driver_review.restore', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(250, 'driver_review.forceDelete', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(251, 'rider_review.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(252, 'rider_review.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(253, 'rider_review.destroy', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(254, 'rider_review.restore', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(255, 'rider_review.forceDelete', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(256, 'hourly_package.index', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(257, 'hourly_package.create', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(258, 'hourly_package.edit', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(259, 'hourly_package.destroy', 'web', '2025-04-26 01:49:57', '2025-04-26 01:49:57'),
(260, 'hourly_package.restore', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(261, 'hourly_package.forceDelete', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(262, 'sos_alert.index', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(263, 'sos_alert.create', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(264, 'sos_alert.edit', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(265, 'sos_alert.destroy', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(266, 'sos_alert.restore', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(267, 'sos_alert.forceDelete', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(268, 'rental_vehicle.index', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(269, 'rental_vehicle.create', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(270, 'rental_vehicle.edit', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(271, 'rental_vehicle.destroy', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(272, 'rental_vehicle.restore', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(273, 'rental_vehicle.forceDelete', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(274, 'fleet_manager.index', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(275, 'fleet_manager.create', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(276, 'fleet_manager.edit', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(277, 'fleet_manager.destroy', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(278, 'fleet_manager.restore', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(279, 'fleet_manager.forceDelete', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(280, 'fleet_wallet.index', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(281, 'fleet_wallet.credit', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(282, 'fleet_wallet.debit', 'web', '2025-04-26 01:49:58', '2025-04-26 01:49:58'),
(283, 'ticket.ticket.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(284, 'ticket.ticket.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(285, 'ticket.ticket.reply', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(286, 'ticket.ticket.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(287, 'ticket.ticket.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(288, 'ticket.ticket.forceDelete', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(289, 'ticket.priority.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(290, 'ticket.priority.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(291, 'ticket.priority.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(292, 'ticket.priority.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(293, 'ticket.priority.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(294, 'ticket.priority.forceDelete', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(295, 'ticket.executive.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(296, 'ticket.executive.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(297, 'ticket.executive.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(298, 'ticket.executive.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(299, 'ticket.executive.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(300, 'ticket.executive.forceDelete', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(301, 'ticket.department.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(302, 'ticket.department.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(303, 'ticket.department.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(304, 'ticket.department.show', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(305, 'ticket.department.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(306, 'ticket.department.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(307, 'ticket.department.forceDelete', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(308, 'ticket.formfield.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(309, 'ticket.formfield.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(310, 'ticket.formfield.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(311, 'ticket.formfield.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(312, 'ticket.formfield.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(313, 'ticket.formfield.forceDelete', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(314, 'ticket.status.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(315, 'ticket.status.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(316, 'ticket.status.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(317, 'ticket.status.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(318, 'ticket.status.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(319, 'ticket.status.forceDelete', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(320, 'ticket.knowledge.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(321, 'ticket.knowledge.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(322, 'ticket.knowledge.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(323, 'ticket.knowledge.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(324, 'ticket.knowledge.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(325, 'ticket.knowledge.forceDelete', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(326, 'ticket.category.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(327, 'ticket.category.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(328, 'ticket.category.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(329, 'ticket.category.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(330, 'ticket.tag.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(331, 'ticket.tag.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(332, 'ticket.tag.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(333, 'ticket.tag.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(334, 'ticket.tag.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(335, 'ticket.tag.forceDelete', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(336, 'ticket.setting.index', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(337, 'ticket.setting.create', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(338, 'ticket.setting.edit', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(339, 'ticket.setting.destroy', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(340, 'ticket.setting.restore', 'web', '2025-04-26 01:50:10', '2025-04-26 01:50:10'),
(341, 'ticket.setting.forceDelete', 'web', '2025-04-26 01:50:11', '2025-04-26 01:50:11');

INSERT INTO `roles` (`id`, `name`, `guard_name`, `system_reserve`, `module`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', 1, NULL, 1, '2025-03-16 23:08:06', '2025-03-16 23:08:06'),
(2, 'user', 'web', 1, NULL, 1, '2025-03-16 23:08:07', '2025-03-16 23:08:07'),
(3, 'rider', 'web', 1, 16, 1, '2025-03-16 23:08:34', '2025-03-16 23:08:34'),
(4, 'driver', 'web', 1, 16, 1, '2025-03-16 23:08:35', '2025-03-16 23:08:35'),
(5, 'executive', 'web', 1, 17, 1, '2025-03-16 23:10:10', '2025-03-16 23:10:10'),
(6, 'dispatcher', 'web', 1, 16, 1, '2025-03-16 23:08:35', '2025-03-16 23:08:35'),
(7,'fleet_manager', 'web', 1, 16, 1, '2025-04-21 22:52:38', '2025-04-21 22:52:38');

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 1),
(13, 'App\\Models\\User', 1),
(14, 'App\\Models\\User', 1),
(15, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 1),
(17, 'App\\Models\\User', 1),
(18, 'App\\Models\\User', 1),
(19, 'App\\Models\\User', 1),
(20, 'App\\Models\\User', 1),
(21, 'App\\Models\\User', 1),
(22, 'App\\Models\\User', 1),
(23, 'App\\Models\\User', 1),
(24, 'App\\Models\\User', 1),
(25, 'App\\Models\\User', 1),
(26, 'App\\Models\\User', 1),
(27, 'App\\Models\\User', 1),
(28, 'App\\Models\\User', 1),
(29, 'App\\Models\\User', 1),
(30, 'App\\Models\\User', 1),
(31, 'App\\Models\\User', 1),
(32, 'App\\Models\\User', 1),
(33, 'App\\Models\\User', 1),
(34, 'App\\Models\\User', 1),
(35, 'App\\Models\\User', 1),
(36, 'App\\Models\\User', 1),
(37, 'App\\Models\\User', 1),
(38, 'App\\Models\\User', 1),
(39, 'App\\Models\\User', 1),
(40, 'App\\Models\\User', 1),
(41, 'App\\Models\\User', 1),
(42, 'App\\Models\\User', 1),
(43, 'App\\Models\\User', 1),
(44, 'App\\Models\\User', 1),
(45, 'App\\Models\\User', 1),
(46, 'App\\Models\\User', 1),
(47, 'App\\Models\\User', 1),
(48, 'App\\Models\\User', 1),
(49, 'App\\Models\\User', 1),
(50, 'App\\Models\\User', 1),
(51, 'App\\Models\\User', 1),
(52, 'App\\Models\\User', 1),
(53, 'App\\Models\\User', 1),
(54, 'App\\Models\\User', 1),
(55, 'App\\Models\\User', 1),
(56, 'App\\Models\\User', 1),
(57, 'App\\Models\\User', 1),
(58, 'App\\Models\\User', 1),
(59, 'App\\Models\\User', 1),
(60, 'App\\Models\\User', 1),
(61, 'App\\Models\\User', 1),
(62, 'App\\Models\\User', 1),
(63, 'App\\Models\\User', 1),
(64, 'App\\Models\\User', 1),
(65, 'App\\Models\\User', 1),
(66, 'App\\Models\\User', 1),
(67, 'App\\Models\\User', 1),
(68, 'App\\Models\\User', 1),
(69, 'App\\Models\\User', 1),
(70, 'App\\Models\\User', 1),
(71, 'App\\Models\\User', 1),
(72, 'App\\Models\\User', 1),
(73, 'App\\Models\\User', 1),
(74, 'App\\Models\\User', 1),
(75, 'App\\Models\\User', 1),
(76, 'App\\Models\\User', 1),
(77, 'App\\Models\\User', 1),
(78, 'App\\Models\\User', 1),
(79, 'App\\Models\\User', 1),
(80, 'App\\Models\\User', 1),
(81, 'App\\Models\\User', 1),
(82, 'App\\Models\\User', 1),
(83, 'App\\Models\\User', 1),
(84, 'App\\Models\\User', 1),
(85, 'App\\Models\\User', 1),
(86, 'App\\Models\\User', 1),
(87, 'App\\Models\\User', 1),
(88, 'App\\Models\\User', 1),
(89, 'App\\Models\\User', 1),
(90, 'App\\Models\\User', 1),
(91, 'App\\Models\\User', 1),
(92, 'App\\Models\\User', 1),
(93, 'App\\Models\\User', 1),
(94, 'App\\Models\\User', 1),
(95, 'App\\Models\\User', 1),
(96, 'App\\Models\\User', 1),
(97, 'App\\Models\\User', 1),
(98, 'App\\Models\\User', 1),
(99, 'App\\Models\\User', 1),
(100, 'App\\Models\\User', 1),
(101, 'App\\Models\\User', 1),
(102, 'App\\Models\\User', 1),
(103, 'App\\Models\\User', 1),
(104, 'App\\Models\\User', 1),
(105, 'App\\Models\\User', 1),
(106, 'App\\Models\\User', 1),
(107, 'App\\Models\\User', 1),
(108, 'App\\Models\\User', 1),
(109, 'App\\Models\\User', 1),
(110, 'App\\Models\\User', 1),
(111, 'App\\Models\\User', 1),
(112, 'App\\Models\\User', 1),
(113, 'App\\Models\\User', 1),
(114, 'App\\Models\\User', 1),
(115, 'App\\Models\\User', 1),
(116, 'App\\Models\\User', 1),
(117, 'App\\Models\\User', 1),
(118, 'App\\Models\\User', 1),
(119, 'App\\Models\\User', 1),
(120, 'App\\Models\\User', 1),
(121, 'App\\Models\\User', 1),
(122, 'App\\Models\\User', 1),
(123, 'App\\Models\\User', 1),
(124, 'App\\Models\\User', 1),
(125, 'App\\Models\\User', 1),
(126, 'App\\Models\\User', 1),
(127, 'App\\Models\\User', 1),
(128, 'App\\Models\\User', 1),
(129, 'App\\Models\\User', 1),
(130, 'App\\Models\\User', 1),
(131, 'App\\Models\\User', 1),
(132, 'App\\Models\\User', 1),
(133, 'App\\Models\\User', 1),
(134, 'App\\Models\\User', 1),
(135, 'App\\Models\\User', 1),
(136, 'App\\Models\\User', 1),
(137, 'App\\Models\\User', 1),
(138, 'App\\Models\\User', 1),
(139, 'App\\Models\\User', 1),
(140, 'App\\Models\\User', 1),
(141, 'App\\Models\\User', 1),
(142, 'App\\Models\\User', 1),
(143, 'App\\Models\\User', 1),
(144, 'App\\Models\\User', 1),
(145, 'App\\Models\\User', 1),
(146, 'App\\Models\\User', 1),
(147, 'App\\Models\\User', 1),
(148, 'App\\Models\\User', 1),
(149, 'App\\Models\\User', 1),
(150, 'App\\Models\\User', 1),
(151, 'App\\Models\\User', 1),
(152, 'App\\Models\\User', 1),
(153, 'App\\Models\\User', 1),
(154, 'App\\Models\\User', 1),
(155, 'App\\Models\\User', 1),
(156, 'App\\Models\\User', 1),
(157, 'App\\Models\\User', 1),
(158, 'App\\Models\\User', 1),
(159, 'App\\Models\\User', 1),
(160, 'App\\Models\\User', 1),
(161, 'App\\Models\\User', 1),
(162, 'App\\Models\\User', 1),
(163, 'App\\Models\\User', 1),
(164, 'App\\Models\\User', 1),
(165, 'App\\Models\\User', 1),
(166, 'App\\Models\\User', 1),
(167, 'App\\Models\\User', 1),
(168, 'App\\Models\\User', 1),
(169, 'App\\Models\\User', 1),
(170, 'App\\Models\\User', 1),
(171, 'App\\Models\\User', 1),
(172, 'App\\Models\\User', 1),
(173, 'App\\Models\\User', 1),
(174, 'App\\Models\\User', 1),
(175, 'App\\Models\\User', 1),
(176, 'App\\Models\\User', 1),
(177, 'App\\Models\\User', 1),
(178, 'App\\Models\\User', 1),
(179, 'App\\Models\\User', 1),
(180, 'App\\Models\\User', 1),
(181, 'App\\Models\\User', 1),
(182, 'App\\Models\\User', 1),
(183, 'App\\Models\\User', 1),
(184, 'App\\Models\\User', 1),
(185, 'App\\Models\\User', 1),
(186, 'App\\Models\\User', 1),
(187, 'App\\Models\\User', 1),
(188, 'App\\Models\\User', 1),
(189, 'App\\Models\\User', 1),
(190, 'App\\Models\\User', 1),
(191, 'App\\Models\\User', 1),
(192, 'App\\Models\\User', 1),
(193, 'App\\Models\\User', 1),
(194, 'App\\Models\\User', 1),
(195, 'App\\Models\\User', 1),
(196, 'App\\Models\\User', 1),
(197, 'App\\Models\\User', 1),
(198, 'App\\Models\\User', 1),
(199, 'App\\Models\\User', 1),
(200, 'App\\Models\\User', 1),
(201, 'App\\Models\\User', 1),
(202, 'App\\Models\\User', 1),
(203, 'App\\Models\\User', 1),
(204, 'App\\Models\\User', 1),
(205, 'App\\Models\\User', 1),
(206, 'App\\Models\\User', 1),
(207, 'App\\Models\\User', 1),
(208, 'App\\Models\\User', 1),
(209, 'App\\Models\\User', 1),
(210, 'App\\Models\\User', 1),
(211, 'App\\Models\\User', 1),
(212, 'App\\Models\\User', 1),
(213, 'App\\Models\\User', 1),
(214, 'App\\Models\\User', 1),
(215, 'App\\Models\\User', 1),
(216, 'App\\Models\\User', 1),
(217, 'App\\Models\\User', 1),
(218, 'App\\Models\\User', 1),
(219, 'App\\Models\\User', 1),
(220, 'App\\Models\\User', 1),
(221, 'App\\Models\\User', 1),
(222, 'App\\Models\\User', 1),
(223, 'App\\Models\\User', 1),
(224, 'App\\Models\\User', 1),
(225, 'App\\Models\\User', 1),
(226, 'App\\Models\\User', 1),
(227, 'App\\Models\\User', 1),
(228, 'App\\Models\\User', 1),
(229, 'App\\Models\\User', 1),
(230, 'App\\Models\\User', 1),
(231, 'App\\Models\\User', 1),
(232, 'App\\Models\\User', 1),
(233, 'App\\Models\\User', 1),
(234, 'App\\Models\\User', 1),
(235, 'App\\Models\\User', 1),
(236, 'App\\Models\\User', 1),
(237, 'App\\Models\\User', 1),
(238, 'App\\Models\\User', 1),
(239, 'App\\Models\\User', 1),
(240, 'App\\Models\\User', 1),
(241, 'App\\Models\\User', 1),
(242, 'App\\Models\\User', 1),
(243, 'App\\Models\\User', 1),
(244, 'App\\Models\\User', 1),
(245, 'App\\Models\\User', 1),
(246, 'App\\Models\\User', 1),
(247, 'App\\Models\\User', 1),
(248, 'App\\Models\\User', 1),
(249, 'App\\Models\\User', 1),
(250, 'App\\Models\\User', 1),
(251, 'App\\Models\\User', 1),
(252, 'App\\Models\\User', 1),
(253, 'App\\Models\\User', 1),
(254, 'App\\Models\\User', 1),
(255, 'App\\Models\\User', 1),
(256, 'App\\Models\\User', 1),
(257, 'App\\Models\\User', 1),
(258, 'App\\Models\\User', 1),
(259, 'App\\Models\\User', 1),
(260, 'App\\Models\\User', 1),
(261, 'App\\Models\\User', 1),
(262, 'App\\Models\\User', 1),
(263, 'App\\Models\\User', 1),
(264, 'App\\Models\\User', 1),
(265, 'App\\Models\\User', 1),
(266, 'App\\Models\\User', 1),
(267, 'App\\Models\\User', 1),
(268, 'App\\Models\\User', 1),
(269, 'App\\Models\\User', 1),
(270, 'App\\Models\\User', 1),
(271, 'App\\Models\\User', 1),
(272, 'App\\Models\\User', 1),
(273, 'App\\Models\\User', 1),
(274, 'App\\Models\\User', 1),
(275, 'App\\Models\\User', 1),
(276, 'App\\Models\\User', 1),
(277, 'App\\Models\\User', 1),
(278, 'App\\Models\\User', 1),
(279, 'App\\Models\\User', 1),
(280, 'App\\Models\\User', 1),
(281, 'App\\Models\\User', 1),
(282, 'App\\Models\\User', 1),
(283, 'App\\Models\\User', 1),
(284, 'App\\Models\\User', 1),
(285, 'App\\Models\\User', 1),
(286, 'App\\Models\\User', 1),
(287, 'App\\Models\\User', 1),
(288, 'App\\Models\\User', 1),
(289, 'App\\Models\\User', 1),
(290, 'App\\Models\\User', 1),
(291, 'App\\Models\\User', 1),
(292, 'App\\Models\\User', 1),
(293, 'App\\Models\\User', 1),
(294, 'App\\Models\\User', 1),
(295, 'App\\Models\\User', 1),
(296, 'App\\Models\\User', 1),
(297, 'App\\Models\\User', 1),
(298, 'App\\Models\\User', 1),
(299, 'App\\Models\\User', 1),
(300, 'App\\Models\\User', 1),
(301, 'App\\Models\\User', 1),
(302, 'App\\Models\\User', 1),
(303, 'App\\Models\\User', 1),
(304, 'App\\Models\\User', 1),
(305, 'App\\Models\\User', 1),
(306, 'App\\Models\\User', 1),
(307, 'App\\Models\\User', 1),
(308, 'App\\Models\\User', 1),
(309, 'App\\Models\\User', 1),
(310, 'App\\Models\\User', 1),
(311, 'App\\Models\\User', 1),
(312, 'App\\Models\\User', 1),
(313, 'App\\Models\\User', 1),
(314, 'App\\Models\\User', 1),
(315, 'App\\Models\\User', 1),
(316, 'App\\Models\\User', 1),
(317, 'App\\Models\\User', 1),
(318, 'App\\Models\\User', 1),
(319, 'App\\Models\\User', 1),
(320, 'App\\Models\\User', 1),
(321, 'App\\Models\\User', 1),
(322, 'App\\Models\\User', 1),
(323, 'App\\Models\\User', 1),
(324, 'App\\Models\\User', 1),
(325, 'App\\Models\\User', 1),
(326, 'App\\Models\\User', 1),
(327, 'App\\Models\\User', 1),
(328, 'App\\Models\\User', 1),
(329, 'App\\Models\\User', 1),
(330, 'App\\Models\\User', 1),
(331, 'App\\Models\\User', 1),
(332, 'App\\Models\\User', 1),
(333, 'App\\Models\\User', 1),
(334, 'App\\Models\\User', 1),
(335, 'App\\Models\\User', 1),
(336, 'App\\Models\\User', 1),
(337, 'App\\Models\\User', 1),
(338, 'App\\Models\\User', 1),
(339, 'App\\Models\\User', 1),
(340, 'App\\Models\\User', 1),
(341, 'App\\Models\\User', 1);

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(4, 'App\\Models\\User', 17),
(4, 'App\\Models\\User', 18),
(4, 'App\\Models\\User', 19),
(4, 'App\\Models\\User', 20),
(4, 'App\\Models\\User', 21),
(4, 'App\\Models\\User', 22),
(4, 'App\\Models\\User', 23),
(4, 'App\\Models\\User', 24),
(4, 'App\\Models\\User', 25),
(4, 'App\\Models\\User', 26),
(4, 'App\\Models\\User', 27),
(4, 'App\\Models\\User', 28),
(4, 'App\\Models\\User', 29),
(4, 'App\\Models\\User', 30),
(4, 'App\\Models\\User', 31),
(4, 'App\\Models\\User', 32),
(4, 'App\\Models\\User', 33),
(4, 'App\\Models\\User', 34),
(4, 'App\\Models\\User', 35),
(4, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 40),
(3, 'App\\Models\\User', 41),
(3, 'App\\Models\\User', 42),
(3, 'App\\Models\\User', 43),
(2, 'App\\Models\\User', 44),
(2, 'App\\Models\\User', 45),
(2, 'App\\Models\\User', 46),
(2, 'App\\Models\\User', 47),
(2, 'App\\Models\\User', 48),
(5, 'App\\Models\\User', 49),
(5, 'App\\Models\\User', 50),
(5, 'App\\Models\\User', 51),
(5, 'App\\Models\\User', 52),
(5, 'App\\Models\\User', 53),
(4, 'App\\Models\\User', 54),
(4, 'App\\Models\\User', 55),
(2, 'App\\Models\\User', 56),
(6, 'App\\Models\\User', 57);

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(21, 2),
(25, 2),
(31, 2),
(37, 2),
(43, 2),
(49, 2),
(55, 2),
(61, 2),
(91, 2),
(283, 2),
(284, 2),
(285, 2),
(286, 2),
(287, 2),
(288, 2),
(320, 2),
(326, 2),
(330, 2),
(97, 3),
(109, 3),
(121, 3),
(127, 3),
(133, 3),
(139, 3),
(163, 3),
(191, 3),
(195, 3),
(199, 3),
(200, 3),
(201, 3),
(202, 3),
(205, 3),
(206, 3),
(207, 3),
(208, 3),
(220, 3),
(222, 3),
(227, 3),
(240, 3),
(246, 3),
(247, 3),
(251, 3),
(256, 3),
(262, 3),
(268, 3),
(103, 4),
(105, 4),
(127, 4),
(133, 4),
(157, 4),
(163, 4),
(169, 4),
(170, 4),
(175, 4),
(181, 4),
(188, 4),
(191, 4),
(195, 4),
(199, 4),
(201, 4),
(205, 4),
(207, 4),
(208, 4),
(214, 4),
(218, 4),
(219, 4),
(220, 4),
(221, 4),
(230, 4),
(246, 4),
(251, 4),
(252, 4),
(256, 4),
(262, 4),
(268, 4),
(269, 4),
(270, 4),
(271, 4),
(272, 4),
(274, 4),
(103, 6),
(105, 6),
(109, 6),
(111, 6),
(115, 6),
(133, 6),
(145, 6),
(157, 6),
(191, 6),
(195, 6),
(199, 6),
(201, 6),
(202, 6),
(203, 6),
(205, 6),
(207, 6),
(238, 6),
(240, 6),
(103, 7),
(133, 7),
(145, 7),
(157, 7),
(169, 7),
(175, 7),
(181, 7),
(191, 7),
(195, 7),
(199, 7),
(205, 7),
(230, 7),
(231, 7),
(233, 7),
(234, 7),
(238, 7),
(274, 7),
(275, 7),
(276, 7),
(277, 7),
(278, 7),
(280, 7),
(283, 5),
(284, 5),
(285, 5);

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2017_08_11_073824_create_menus_wp_table', 1),
(6, '2017_08_11_074006_create_menu_items_wp_table', 1),
(7, '2021_11_25_094447_create_countries_table', 1),
(8, '2022_05_30_090203_create_media_table', 1),
(9, '2022_09_28_105314_create_categories_table', 1),
(10, '2022_10_01_135505_create_tags_table', 1),
(11, '2023_04_20_044705_create_notifications_table', 1),
(12, '2023_05_30_112559_create_modules_table', 1),
(13, '2023_10_07_060301_create_blogs_table', 1),
(14, '2023_11_15_131828_create_pages_table', 1),
(15, '2023_12_05_062849_create_payment_gateways_table', 1),
(16, '2024_04_20_061325_create_plugins_table', 1),
(17, '2024_05_01_042107_create_auth_tokens_table', 1),
(18, '2024_05_23_082318_create_personal_access_tokens_table', 1),
(19, '2024_05_25_081827_create_permission_tables', 1),
(20, '2024_07_09_095953_create_taxes_table', 1),
(21, '2024_07_09_104520_create_currencies_table', 1),
(22, '2024_07_12_043614_create_languages_table', 1),
(23, '2024_07_12_044309_add_columns_users_table', 1),
(24, '2024_07_12_044309_create_settings_table', 1),
(25, '2024_07_12_044309_create_taxido_settings_table', 1),
(26, '2024_07_18_084646_create_banners_table', 1),
(27, '2024_07_18_084724_create_documents_table', 1),
(28, '2024_07_18_084754_create_services_table', 1),
(29, '2024_07_18_084755_create_vehicle_types_table', 1),
(30, '2024_07_19_082823_create_priorities_table', 1),
(31, '2024_07_19_090319_create_zones_table', 1),
(32, '2024_07_19_090419_create_addresses_table', 1),
(33, '2024_07_19_130334_create_faqs_table', 1),
(34, '2024_07_22_070950_create_driver_rules_table', 1),
(35, '2024_07_22_090803_create_form_fields_table', 1),
(36, '2024_07_22_124552_create_payment_accounts_table', 1),
(37, '2024_07_24_083029_create_message_table', 1),
(38, '2024_07_24_101439_create_wallets_table', 1),
(39, '2024_07_24_103346_create_driver_documents_table', 1),
(40, '2024_07_25_052049_create_ticket_settings_table', 1),
(41, '2024_08_01_061513_create_statuses_table', 1),
(42, '2024_08_02_115838_create_hourly_packages_table', 1),
(43, '2024_08_02_130158_create_coupons_table', 1),
(44, '2024_08_12_045713_create_departments_table', 1),
(45, '2024_08_12_115839_create_service_categories_table', 1),
(46, '2024_08_13_052445_create_tickets_table', 1),
(47, '2024_08_29_102551_create_withdraw_requests_table', 1),
(48, '2024_08_31_033317_add_alternative_text_to_media_table', 1),
(49, '2024_08_31_052446_create_reports_table', 1),
(50, '2024_09_03_070923_create_push_notifications_table', 1),
(51, '2024_09_03_072944_create_ratings_table', 1),
(52, '2024_09_06_122033_create_knowledge_base_categories_table', 1),
(53, '2024_09_06_123438_create_landing_pages_table', 1),
(54, '2024_09_07_094637_create_knowledge_base_tags_table', 1),
(55, '2024_09_09_094216_create_knowledge_bases_table', 1),
(56, '2024_09_09_115527_create_cancellation_reasons_table', 1),
(57, '2024_10_01_124515_create_rental_vehicles', 1),
(58, '2024_10_02_115840_create_rides_table', 1),
(59, '2024_10_07_120923_create_rider_reviews_table', 1),
(60, '2024_10_07_121023_create_driver_reviews_table', 1),
(61, '2024_10_08_070424_create_sos_table', 1),
(62, '2024_10_12_083722_create_email_templates', 1),
(63, '2024_10_14_111617_create_sms_templates', 1),
(64, '2024_10_15_041531_create_push_notification_templates', 1),
(65, '2024_11_22_062049_create_notices_table', 1),
(66, '2024_11_25_035910_create_testimonials_table', 1),
(67, '2024_11_27_054315_create_backup_logs', 1),
(68, '2024_11_28_120846_create_activity_log_table', 1),
(69, '2024_11_28_120847_add_event_column_to_activity_log_table', 1),
(70, '2024_11_28_120848_add_batch_uuid_column_to_activity_log_table', 1),
(71, '2024_12_16_035102_create_customizations_table', 1),
(72, '2024_12_22_060359_create_cab_commission_histories_table', 1),
(73, '2025_01_03_092822_create_plans_table', 1),
(74, '2025_01_20_133742_2023_10_07_060301_create_subscribes_table', 1),
(75, '2025_03_12_052604_create_onboardings_table', 1);

TRUNCATE `menu_items`;
INSERT INTO `menu_items` (`id`, `label`, `route`, `params`, `slug`, `permission`, `parent`, `module`, `section`, `sort`, `class`, `icon`, `badge`, `badgeable`, `menu`, `depth`, `quick_link`, `status`, `role_id`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'static.dashboard', 'admin.dashboard.index', NULL, 'staticdashboard', '', 0, NULL, 'static.home', 0, NULL, 'ri-dashboard-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(2, 'static.users.users', 'admin.user.index', NULL, 'staticusersusers', 'user.index', 0, NULL, 'static.user_management', 1, NULL, 'ri-group-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(3, 'static.users.all', 'admin.user.index', NULL, 'staticusersall', 'user.index', 2, NULL, 'static.user_management', 2, NULL, 'ri-user-3-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(4, 'static.users.add', 'admin.user.create', NULL, 'staticusersadd', 'user.create', 2, NULL, 'static.user_management', 3, NULL, 'ri-user-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(5, 'static.users.role_permissions', 'admin.role.index', NULL, 'staticusersrole-permissions', 'role.index', 2, NULL, 'static.user_management', 4, NULL, 'ri-lock-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(6, 'static.media.media', 'admin.media.index', NULL, 'staticmediamedia', 'attachment.index', 0, NULL, 'static.home', 5, NULL, 'ri-folder-open-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(7, 'static.blogs.blogs', 'admin.blog.index', NULL, 'staticblogsblogs', 'blog.index', 0, NULL, 'static.content_management', 6, NULL, 'ri-pushpin-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(8, 'static.blogs.all_blogs', 'admin.blog.index', NULL, 'staticblogsall-blogs', 'blog.index', 7, NULL, 'static.content_management', 7, NULL, 'ri-bookmark-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(9, 'static.blogs.add_blogs', 'admin.blog.create', NULL, 'staticblogsadd-blogs', 'blog.create', 7, NULL, 'static.content_management', 8, NULL, 'ri-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(10, 'static.categories.categories', 'admin.category.index', NULL, 'staticcategoriescategories', 'category.index', 7, NULL, 'static.content_management', 9, NULL, 'ri-folder-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(11, 'static.tags.tags', 'admin.tag.index', NULL, 'statictagstags', 'tag.index', 7, NULL, 'static.content_management', 10, NULL, 'ri-price-tag-3-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(12, 'static.pages.pages', 'admin.page.index', NULL, 'staticpagespages', 'page.index', 0, NULL, 'static.content_management', 11, NULL, 'ri-pages-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(13, 'static.pages.all_page', 'admin.page.index', NULL, 'staticpagesall-page', 'page.index', 12, NULL, 'static.content_management', 12, NULL, 'ri-list-check', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(14, 'static.pages.add', 'admin.page.create', NULL, 'staticpagesadd', 'page.create', 12, NULL, 'static.content_management', 13, NULL, 'ri-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(15, 'static.notify_templates.notify_templates', 'admin.email-template.index', NULL, 'staticnotify-templatesnotify-templates', 'email_template.index', 0, NULL, 'static.promotion_management', 14, NULL, 'ri-pushpin-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(16, 'static.notify_templates.email', 'admin.email-template.index', NULL, 'staticnotify-templatesemail', 'email_template.index', 15, NULL, 'static.promotion_management', 15, NULL, 'ri-dashboard-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(17, 'static.notify_templates.sms', 'admin.sms-template.index', NULL, 'staticnotify-templatessms', 'sms_template.index', 15, NULL, 'static.promotion_management', 16, NULL, 'ri-dashboard-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(18, 'static.notify_templates.push_notification', 'admin.push-notification-template.index', NULL, 'staticnotify-templatespush-notification', 'push_notification_template.index', 15, NULL, 'static.promotion_management', 17, NULL, 'ri-dashboard-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(19, 'static.testimonials.testimonials', 'admin.testimonial.index', NULL, 'statictestimonialstestimonials', 'testimonial.index', 0, NULL, 'static.promotion_management', 18, NULL, 'ri-group-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(20, 'static.testimonials.all_testimonials', 'admin.testimonial.index', NULL, 'statictestimonialsall-testimonials', 'testimonial.index', 19, NULL, 'static.promotion_management', 19, NULL, 'ri-list-check', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(21, 'static.testimonials.add', 'admin.testimonial.create', NULL, 'statictestimonialsadd', 'testimonial.create', 19, NULL, 'static.promotion_management', 20, NULL, 'ri-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(22, 'static.faqs.faqs', 'admin.faq.index', NULL, 'staticfaqsfaqs', 'faq.index', 0, NULL, 'static.content_management', 21, NULL, 'ri-questionnaire-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(23, 'static.general_settings', 'admin.setting.index', NULL, 'staticgeneral-settings', 'setting.index', 0, NULL, 'static.setting_management', 22, NULL, 'ri-settings-5-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(24, 'static.languages.languages', 'admin.language.index', NULL, 'staticlanguageslanguages', 'language.index', 23, NULL, 'static.setting_management', 23, NULL, 'ri-translate-2', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(25, 'static.taxes.taxes', 'admin.tax.index', NULL, 'statictaxestaxes', 'tax.index', 23, NULL, 'static.financial_management', 24, NULL, 'ri-percent-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(26, 'static.currencies.currencies', 'admin.currency.index', NULL, 'staticcurrenciescurrencies', 'currency.index', 23, NULL, 'static.financial_management', 25, NULL, 'ri-currency-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(27, 'static.plugins.plugins', 'admin.plugin.index', NULL, 'staticpluginsplugins', 'plugin.index', 23, NULL, 'static.setting_management', 26, NULL, 'ri-plug-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(28, 'static.payment_methods.payment_methods', 'admin.payment-method.index', NULL, 'staticpayment-methodspayment-methods', 'payment-method.index', 23, NULL, 'static.setting_management', 27, NULL, 'ri-secure-payment-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(29, 'static.sms_gateways.sms_gateways', 'admin.sms-gateway.index', NULL, 'staticsms-gatewayssms-gateways', 'sms-gateway.index', 23, NULL, 'static.setting_management', 28, NULL, 'ri-message-2-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(30, 'static.systems.about', 'admin.about-system.index', NULL, 'staticsystemsabout', 'about-system.index', 23, NULL, 'static.setting_management', 29, NULL, 'ri-apps-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(31, 'static.settings.settings', 'admin.setting.index', NULL, 'staticsettingssettings', 'setting.index', 23, NULL, 'static.setting_management', 30, NULL, 'ri-settings-5-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(32, 'static.appearance.appearance', 'admin.robot.index', NULL, 'staticappearanceappearance', 'appearance.index', 0, NULL, 'static.setting_management', 31, NULL, 'ri-swap-3-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(33, 'static.appearance.robots', 'admin.robot.index', NULL, 'staticappearancerobots', 'appearance.index', 32, NULL, 'static.setting_management', 32, NULL, '', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(34, 'static.landing_pages.landing_page_title', 'admin.landing-page.index', NULL, 'staticlanding-pageslanding-page-title', 'landing_page.index', 32, NULL, 'static.setting_management', 33, NULL, 'ri-pages-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(35, 'static.landing_pages.subscribers', 'admin.subscribes', NULL, 'staticlanding-pagessubscribers', 'landing_page.index', 32, NULL, 'static.setting_management', 34, NULL, 'ri-pages-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(36, 'static.appearance.customizations', 'admin.customization.index', NULL, 'staticappearancecustomizations', 'appearance.index', 32, NULL, 'static.setting_management', 35, NULL, 'ri-pages-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(37, 'static.system_tools.system_tools', 'admin.backup.index', NULL, 'staticsystem-toolssystem-tools', 'system-tool.index', 0, NULL, 'static.setting_management', 36, NULL, 'ri-shield-user-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(38, 'static.system_tools.backup', 'admin.backup.index', NULL, 'staticsystem-toolsbackup', 'system-tool.index', 37, NULL, 'static.setting_management', 37, NULL, '', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(39, 'static.system_tools.activity_logs', 'admin.activity-logs.index', NULL, 'staticsystem-toolsactivity-logs', 'system-tool.index', 37, NULL, 'static.setting_management', 38, NULL, '', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(40, 'static.system_tools.database_cleanup', 'admin.cleanup-db.index', NULL, 'staticsystem-toolsdatabase-cleanup', 'system-tool.index', 37, NULL, 'static.setting_management', 39, NULL, '', 0, 0, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),
(41, 'static.menus.menus', 'admin.menu.index', NULL, 'staticmenusmenus', 'menu.index', 0, NULL, 'static.setting_management', 40, NULL, 'ri-menu-2-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:16', '2025-04-30 01:31:16', NULL),

(44, 'taxido::static.riders.add', 'admin.rider.create', NULL, 'tx_rider_create', 'rider.create', 42, 1, 'static.user_management', 42, NULL, 'ri-user-add-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(45, 'taxido::static.wallets.wallet', 'admin.rider-wallet.index', NULL, 'tx_rider_wallet', 'rider_wallet.index', 42, 1, 'static.user_management', 43, NULL, 'ri-wallet-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(46, 'taxido::static.drivers.drivers', NULL, NULL, 'tx_drivers', 'driver.index', 0, 1, 'static.user_management', 4, NULL, 'ri-user-2-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(47, 'taxido::static.drivers.verified_drivers', 'admin.driver.index', NULL, 'tx_all_drivers', 'driver.index', 46, 1, 'static.user_management', 44, NULL, 'ri-check-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(48, 'taxido::static.drivers.unverified_driver', 'admin.driver.unverified-drivers', NULL, 'tx_unverified_drivers', 'unverified_driver.index', 46, 1, 'static.user_management', 45, NULL, 'ri-alert-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(49, 'taxido::static.drivers.add', 'admin.driver.create', NULL, 'tx_driver_add', 'driver.create', 46, 1, 'static.user_management', 46, NULL, 'ri-add-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(50, 'taxido::static.driver_documents.driver_documents', 'admin.driver-document.index', NULL, 'tx_driverDocument', 'driver_document.index', 46, 1, 'static.user_management', 47, NULL, 'ri-document-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(51, 'taxido::static.driver_rules.driver_rules', 'admin.driver-rule.index', NULL, 'tx_driverRule', 'driver_rule.index', 46, 1, 'static.user_management', 48, NULL, 'ri-gavel-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(52, 'taxido::static.locations.driver_location', 'admin.driver-location.index', NULL, 'tx_locations', 'driver_location.index', 46, 1, 'static.user_management', 49, NULL, 'ri-road-map-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(53, 'taxido::static.notices.notice', 'admin.notice.index', NULL, 'taxido::staticnoticesnotice', 'notice.index', 46, 1, 'static.user_management', 50, NULL, 'ri-notice-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(54, 'taxido::static.wallets.wallet', 'admin.driver-wallet.index', NULL, 'taxido::staticwalletswallet', 'driver_wallet.index', 46, 1, 'static.user_management', 51, NULL, 'ri-wallet-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(55, 'taxido::static.withdraw_requests.withdraw_request', 'admin.withdraw-request.index', NULL, 'tx_withdrawRequest', 'withdraw_request.index', 46, 1, 'static.user_management', 52, NULL, 'ri-money-dollar-circle-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(56, 'taxido::static.commission_histories.commission_histories', 'admin.cab-commission-history.index', NULL, 'tx_commissionHistory', 'cab_commission_history.index', 46, 1, 'static.user_management', 53, NULL, 'ri-money-dollar-circle-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),

(58, 'taxido::static.dispatchers.all', 'admin.dispatcher.index', NULL, 'tx_all_dispatchers', 'dispatcher.index', 57, 1, 'static.user_management', 55, NULL, 'ri-team-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(59, 'taxido::static.dispatchers.add', 'admin.dispatcher.create', NULL, 'tx_dispatcher_create', 'dispatcher.create', 57, 1, 'static.user_management', 56, NULL, 'ri-user-add-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(60, 'taxido::static.fleet_managers.fleet_managers', NULL, NULL, 'tx_fleet_manager', 'fleet_manager.index', 0, 1, 'static.user_management', 57, NULL, 'ri-truck-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(61, 'taxido::static.fleet_managers.all', 'admin.fleet-manager.index', NULL, 'tx_all_fleet_managers', 'fleet_manager.index', 60, 1, 'static.user_management', 58, NULL, 'ri-team-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(62, 'taxido::static.fleet_managers.add', 'admin.fleet-manager.create', NULL, 'tx_fleet_manager_create', 'fleet_manager.create', 60, 1, 'static.user_management', 59, NULL, 'ri-user-add-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(63, 'taxido::static.wallets.wallet', 'admin.fleet-wallet.index', NULL, 'tx_fleet_manager_wallet', 'fleet_wallet.index', 60, 1, 'static.user_management', 60, NULL, 'ri-wallet-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(64, 'taxido::static.fleet_withdraw_requests.withdraw_request', 'admin.fleet-withdraw-request.index', NULL, 'tx_fleet_withdrawRequest', 'fleet_withdraw_request.index', 60, 1, 'static.user_management', 61, NULL, 'ri-money-dollar-circle-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(65, 'taxido::static.zones.zones', NULL, NULL, 'zones', 'zone.index', 0, 1, 'taxido::static.cab_management', 6, NULL, 'ri-route-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(66, 'taxido::static.zones.zones', 'admin.zone.index', NULL, 'tx_zones', 'zone.index', 65, 1, 'taxido::static.cab_management', 62, NULL, 'ri-map-2-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:40', NULL),
(67, 'taxido::static.zones.add', 'admin.zone.create', NULL, 'tx_zones_create', 'zone.create', 65, 1, 'taxido::static.cab_management', 63, NULL, 'ri-map-2-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(68, 'taxido::static.services.services', 'admin.service.index', NULL, 'tx_service', 'service.index', 0, 1, 'taxido::static.cab_management', 7, NULL, 'ri-pin-distance-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(69, 'taxido::static.services.cab', NULL, NULL, 'tx_service_cab', 'service.index', 0, 1, 'static.home', 8, NULL, 'ri-roadster-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(70, 'taxido::static.service_categories.serviceCategory', 'admin.service-category.cab.index', NULL, 'tx_service_categories_cab', 'service.index', 69, 1, 'static.home', 8, NULL, 'ri-taxi-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(71, 'taxido::static.service_categories.vehicles', 'admin.vehicle-type.cab.index', NULL, 'tx_service_categories_vehicle_cab', 'service.index', 69, 1, 'static.home', 8, NULL, 'ri-taxi-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(72, 'taxido::static.services.freight', NULL, NULL, 'tx_service_freight', 'service.index', 0, 1, 'static.home', 9, NULL, 'ri-truck-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(73, 'taxido::static.service_categories.serviceCategory', 'admin.service-category.freight.index', NULL, 'tx_service_categories_freight', 'service.index', 72, 1, 'static.home', 8, NULL, 'ri-taxi-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(74, 'taxido::static.service_categories.vehicles', 'admin.vehicle-type.freight.index', NULL, 'tx_service_categories_vehicle_freight', 'service.index', 72, 1, 'static.home', 8, NULL, 'ri-taxi-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(75, 'taxido::static.services.parcel', NULL, NULL, 'tx_service_parcel', 'service.index', 0, 1, 'static.home', 9, NULL, 'ri-archive-2-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(76, 'taxido::static.service_categories.serviceCategory', 'admin.service-category.parcel.index', NULL, 'tx_service_categories_parcel', 'service.index', 75, 1, 'static.home', 8, NULL, 'ri-taxi-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(77, 'taxido::static.service_categories.vehicles', 'admin.vehicle-type.parcel.index', NULL, 'tx_service_categories_vehicle_parcel', 'service.index', 75, 1, 'static.home', 8, NULL, 'ri-taxi-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(78, 'taxido::static.heatmaps.heat_map', 'admin.heat-map', NULL, 'tx_heatmap', 'heat_map.index', 0, 1, 'taxido::static.cab_management', 9, NULL, 'ri-fire-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(79, 'taxido::static.vehicles', NULL, NULL, 'taxido', 'vehicle_type.index', 0, 1, 'taxido::static.cab_management', 10, NULL, 'ri-taxi-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(80, 'taxido::static.rental_vehicle.rental_vehicles', 'admin.rental-vehicle.index', NULL, 'tx_rental_vehicle', 'rental_vehicle.index', 79, 1, 'taxido::static.cab_management', 64, NULL, 'ri-clock-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(81, 'taxido::static.hourly_package.hourly_packages', 'admin.hourly-package.index', NULL, 'tx_hourlyPackage', 'hourly_package.index', 79, 1, 'taxido::static.cab_management', 65, NULL, 'ri-clock-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(82, 'taxido::static.documents.documents', 'admin.document.index', NULL, 'tx_documents', 'document.index', 79, 1, 'taxido::static.cab_management', 66, NULL, 'ri-file-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(83, 'taxido::static.cancellation-reasons.cancellation-reasons', 'admin.cancellation-reason.index', NULL, 'tx_cancellationReason', 'cancellation_reason.index', 79, 1, 'taxido::static.cab_management', 67, NULL, 'ri-error-warning-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(84, 'taxido::static.soses.soses', NULL, NULL, 'tx_sos', 'sos.index', 0, 1, 'taxido::static.cab_management', 11, NULL, 'ri-alarm-warning-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(85, 'taxido::static.soses.soses', 'admin.sos.index', NULL, 'tx_soses', 'sos.index', 84, 1, 'taxido::static.cab_management', 68, NULL, 'ri-alert-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(86, 'taxido::static.soses.sos_alerts', 'admin.sos-alerts.index', NULL, 'tx_sos_alerts', 'sos_alert.index', 84, 1, 'taxido::static.cab_management', 69, NULL, 'ri-list-check', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(87, 'taxido::static.subscriptions.subscriptions', NULL, NULL, 'tx_subscription', 'plan.index', 0, 1, 'taxido::static.cab_management', 12, NULL, 'ri-vip-crown-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(88, 'taxido::static.subscriptions.driver_subscription', 'admin.driver-subscription.index', NULL, 'tx_driverSubscription', 'subscription.index', 87, 1, 'taxido::static.cab_management', 70, NULL, 'ri-file-blank-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(89, 'taxido::static.plans.plans', 'admin.plan.index', NULL, 'tx_plans', 'plan.index', 87, 1, 'taxido::static.cab_management', 71, NULL, 'ri-gavel-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(90, 'taxido::static.coupons.coupons', 'admin.coupon.index', NULL, 'tx_coupons', 'coupon.index', 0, 1, 'taxido::static.cab_management', 13, NULL, 'ri-coupon-2-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(91, 'taxido::static.reports.reports', NULL, NULL, 'tx_reports', 'report.index', 0, 1, 'taxido::static.cab_management', 14, NULL, 'ri-folder-chart-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(92, 'taxido::static.reports.transaction_reports', 'admin.transaction-report.index', NULL, 'tx_transaction_reports', 'report.index', 91, 1, 'taxido::static.cab_management', 72, NULL, 'ri-road-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:33', '2025-04-30 01:31:41', NULL),
(93, 'taxido::static.reports.ride_reports', 'admin.ride-report.index', NULL, 'tx_ride_reports', 'report.index', 91, 1, 'taxido::static.cab_management', 73, NULL, 'ri-traffic-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(94, 'taxido::static.reports.driver_reports', 'admin.driver-report.index', NULL, 'tx_driver_reports', 'report.index', 91, 1, 'taxido::static.cab_management', 74, NULL, 'ri-user-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(95, 'taxido::static.reports.coupon_reports', 'admin.coupon-report.index', NULL, 'tx_coupon_reports', 'report.index', 91, 1, 'taxido::static.cab_management', 75, NULL, 'ri-road-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(96, 'taxido::static.reports.zone_reports', 'admin.zone-report.index', NULL, 'tx_zone_reports', 'report.index', 91, 1, 'taxido::static.cab_management', 76, NULL, 'ri-bar-chart-2-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(97, 'taxido::static.reviews.reviews', NULL, NULL, 'tx_reviews', 'driver_review.index', 0, 1, 'taxido::static.cab_management', 14, NULL, 'ri-user-star-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(98, 'taxido::static.reviews.rider_reviews', 'admin.rider-review.index', NULL, 'tx_rider_review', 'rider.create', 97, 1, 'taxido::static.cab_management', 77, NULL, 'ri-star-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(99, 'taxido::static.reviews.driver_reviews', 'admin.driver-review.index', NULL, 'taxido::staticreviewsdriver-reviews', 'driver_review.index', 97, 1, 'taxido::static.cab_management', 78, NULL, 'ri-star-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(100, 'taxido::static.settings.app_settings', 'admin.taxido-setting.index', NULL, 'tx_setting', 'taxido_setting.index', 0, 1, 'taxido::static.cab_management', 16, NULL, 'ri-settings-4-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(101, 'taxido::static.rides.rides', NULL, NULL, 'tx_ride', 'ride.index', 0, 1, 'static.home', 10, NULL, 'ri-map-2-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(102, 'taxido::static.rides.ride_requests', 'admin.ride-request.index', NULL, 'tx_all_ride_requests', 'ride_request.index', 101, 1, 'static.home', 79, NULL, 'ri-traffic-light-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(103, 'taxido::static.rides.all', 'admin.ride.index', NULL, 'tx_all_rides', 'ride.index', 101, 1, 'static.home', 80, NULL, 'ri-traffic-light-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(104, 'taxido::static.rides.scheduled', 'admin.ride.status.filter', '{\"status\":\"scheduled\"}', 'tx_scheduled_rides', 'ride.index', 101, 1, 'static.home', 81, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:40', NULL),
(105, 'taxido::static.rides.accepted', 'admin.ride.status.filter', '{\"status\":\"accepted\"}', 'tx_accepted_rides', 'ride.index', 101, 1, 'static.home', 82, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:40', NULL),
(106, 'taxido::static.rides.arrived', 'admin.ride.status.filter', '{\"status\":\"arrived\"}', 'tx_arrived_rides', 'ride.index', 101, 1, 'static.home', 83, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:40', NULL),
(107, 'taxido::static.rides.started', 'admin.ride.status.filter', '{\"status\":\"started\"}', 'tx_started_rides', 'ride.index', 101, 1, 'static.home', 84, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:40', NULL),
(108, 'taxido::static.rides.cancelled', 'admin.ride.status.filter', '{\"status\":\"cancelled\"}', 'tx_cancelled_rides', 'ride.index', 101, 1, 'static.home', 85, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:40', NULL),
(109, 'taxido::static.rides.completed', 'admin.ride.status.filter', '{\"status\":\"completed\"}', 'tx_completed_rides', 'ride.index', 101, 1, 'static.home', 86, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:40', NULL),
(110, 'taxido::static.banners.banners', 'admin.banner.index', NULL, 'tx_banners', 'banner.index', 0, 1, 'static.promotion_management', 87, NULL, 'ri-todo-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(111, 'taxido::static.onboardings.onboardings', 'admin.onboarding.index', NULL, 'tx_onboardings', 'onboarding.index', 0, 1, 'static.promotion_management', 88, NULL, 'ri-guide-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(112, 'taxido::static.push_notification.push_notification', NULL, NULL, 'tx_pushNotification', 'push_notification.index', 0, 1, 'static.promotion_management', 11, NULL, 'ri-send-plane-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(113, 'taxido::static.push_notification.all', 'admin.push-notification.index', NULL, 'tx_all_pushNotification', 'push_notification.index', 112, 1, 'static.promotion_management', 89, NULL, 'ri-notification-2-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(114, 'taxido::static.push_notification.send', 'admin.push-notification.create', NULL, 'tx_send_pushNotification', 'push_notification.create', 112, 1, 'static.promotion_management', 90, NULL, 'ri-send-plane-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(115, 'ticket::static.ticket.support_ticket', NULL, NULL, 'ticket', 'ticket.ticket.index', 0, 2, 'ticket::static.section', 11, NULL, 'ri-user-voice-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(116, 'ticket::static.ticket.dashboard', 'admin.ticket.dashboard', NULL, 'tc_ticket_dashboard', 'ticket.ticket.index', 115, 2, 'ticket::static.section', 12, NULL, 'ri-group-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(117, 'ticket::static.ticket.all', 'admin.ticket.index', NULL, 'tc_ticket', 'ticket.ticket.index', 115, 2, 'ticket::static.section', 91, NULL, 'ri-group-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(118, 'ticket::static.executive.all_support_executive', 'admin.executive.index', NULL, 'tc_all_executives', 'ticket.executive.index', 115, 2, 'ticket::static.section', 92, NULL, 'ri-team-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(119, 'ticket::static.ticket.status', 'admin.status.index', NULL, 'tc_status', 'ticket.status.index', 115, 2, 'ticket::static.section', 93, NULL, 'ri-group-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(120, 'ticket::static.priority.priority', 'admin.priority.index', NULL, 'tc_priority', 'ticket.priority.index', 115, 2, 'ticket::static.section', 94, NULL, 'ri-group-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(121, 'ticket::static.knowledge.knowledge', NULL, NULL, 'tc_knowledge', 'ticket.knowledge.index', 0, 2, 'ticket::static.section', 13, NULL, 'ri-git-repository-line', 0, NULL, 1, 0, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(122, 'ticket::static.knowledge.all', 'admin.knowledge.index', NULL, 'tc_all_knowledge', 'ticket.knowledge.index', 121, 2, 'ticket::static.section', 95, NULL, 'ri-team-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(123, 'ticket::static.knowledge.add', 'admin.knowledge.create', NULL, 'tc_knowledge_create', 'ticket.knowledge.create', 121, 2, 'ticket::static.section', 96, NULL, 'ri-id-card-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(124, 'ticket::static.knowledge.categories', 'admin.ticket.category.index', NULL, 'tc_category', 'ticket.category.index', 121, 2, 'ticket::static.section', 97, NULL, 'ri-id-card-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(125, 'ticket::static.knowledge.tags', 'admin.ticket.tag.index', NULL, 'tc_tag', 'ticket.tag.index', 121, 2, 'ticket::static.section', 98, NULL, 'ri-id-card-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(126, 'ticket::static.department.department', 'admin.department.index', NULL, 'tc_department', 'ticket.department.index', 115, 2, 'ticket::static.section', 99, NULL, 'ri-group-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(127, 'ticket::static.formfield.formfield', 'admin.formfield.index', NULL, 'tc_formfield', 'ticket.formfield.index', 115, 2, 'ticket::static.section', 100, NULL, 'ri-group-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL),
(128, 'ticket::static.setting.settings', 'admin.ticket.setting.index', NULL, 'tc_setting', 'ticket.setting.index', 115, 2, 'ticket::static.section', 101, NULL, 'ri-group-line', 0, NULL, 1, 1, 0, 1, 0, 1, '2025-04-30 01:31:34', '2025-04-30 01:31:41', NULL);

ALTER TABLE `services` CHANGE `type` `type` ENUM('cab','parcel','freight','ambulance') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'cab';

TRUNCATE `services`;
INSERT INTO `services` (`id`, `name`, `slug`, `description`, `service_image_id`, `service_icon_id`, `type`, `status`, `is_primary`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"en\":\"Cab\",\"ar\":\"سيارة أجرة\",\"fr\":\"Taxi\",\"de\":\"Taxi\"}', 'cab', '{\"en\":\"Quick and reliable ride service.\"}', 6, NULL, 'cab', 1, 1, 1, '2025-04-24 01:20:10', '2025-04-24 01:20:10', NULL),
(2, '{\"en\":\"Parcel\",\"fr\":\"Colis\",\"de\":\"Paket\",\"ar\":\"قطعة\"}', 'parcel', '{\"en\":\"Secure and fast deliveries.\"}', 13, 15, 'parcel', 1, 0, 1, '2025-04-24 01:20:10', '2025-04-24 01:20:10', NULL),
(3, '{\"en\":\"Freight\",\"fr\":\"Fret\",\"de\":\"Fracht\",\"ar\":\"شحن\"}', 'freight', '{\"en\":\"Efficient and reliable goods transport.\"}', 14, 10, 'freight', 1, 0, 1, '2025-04-24 01:20:10', '2025-04-24 01:20:10', NULL),
(4, '{\"en\":\"Ambulance\"}', 'ambulance', '{\"en\":\"Emergency medical transport.\"}', 7, 7, 'ambulance', 1, 0, 1, '2025-04-24 01:20:10', '2025-04-24 01:20:10', NULL);

ALTER TABLE `vehicle_info` ADD `name` LONGTEXT NULL AFTER `id`, ADD `description` LONGTEXT NULL AFTER `name`, ADD `amb_per_dist_fees` DOUBLE NULL AFTER `description`;

DELETE FROM `service_categories`;
INSERT INTO `service_categories` (`id`, `name`, `slug`, `description`, `type`, `service_category_image_id`, `service_id`, `status`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1, '{\"en\":\"Ride\"}', 'ride', '{\"en\":\"Long-distance travel options connecting cities, ideal for both passengers and freight shipments.\"}', 'ride', NULL, 1, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (2, '{\"en\":\"Intercity\"}', 'intercity', '{\"en\":\"For smooth and reliable intracity travel\"}', 'intercity', NULL, 1, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (3, '{\"en\":\"Package\"}', 'package', '{\"en\":\"Package delivery services for both small and large parcels, ensuring timely and secure transport.\"}', 'package', NULL, 1, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (4, '{\"en\":\"Schedule\"}', 'schedule', '{\"en\":\"Scheduled transport services for planned trips, offering both passenger and freight options.\"}', 'schedule', NULL, 1, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (5, '{\"en\":\"Rental\"}', 'rental', '{\"en\":\"Vehicle rentals for short or long-term use, suitable for personal or business requirements.\"}', 'rental', NULL, 1, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (6, '{\"en\":\"Ride\"}', 'ride-parcel', '{\"en\":\"Long-distance travel options connecting cities, ideal for both passengers and freight shipments.\"}', 'ride', NULL, 2, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (7, '{\"en\":\"Intercity\"}', 'intercity-parcel', '{\"en\":\"For smooth and reliable intracity travel\"}', 'intercity', NULL, 2, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (8, '{\"en\":\"Schedule\"}', 'schedule-parcel', '{\"en\":\"Scheduled transport services for planned trips, offering both passenger and freight options.\"}', 'schedule', NULL, 2, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (9, '{\"en\":\"Ride\"}', 'ride-freight', '{\"en\":\"Long-distance travel options connecting cities, ideal for both passengers and freight shipments.\"}', 'ride', NULL, 3, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (10, '{\"en\":\"Intercity\"}', 'intercity-freight', '{\"en\":\"For smooth and reliable intracity travel\"}', 'intercity', NULL, 3, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL),
  (11, '{\"en\":\"Schedule\"}', 'schedule-freight', '{\"en\":\"Scheduled transport services for planned trips, offering both passenger and freight options.\"}', 'schedule', NULL, 3, 1, 1, '2025-04-01 01:25:23', '2025-04-01 01:25:23', NULL);

DELETE FROM `vehicle_types`;
INSERT INTO `vehicle_types` (`id`, `name`, `service_id`, `service_category_id`, `vehicle_image_id`, `vehicle_map_icon_id`, `slug`, `base_amount`, `min_per_unit_charge`, `max_per_unit_charge`, `min_per_min_charge`, `max_per_min_charge`, `min_per_weight_charge`, `max_per_weight_charge`, `cancellation_charge`, `waiting_time_charge`, `commission_type`, `commission_rate`, `created_by_id`, `tax_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"en\":\"Bike\",\"fr\":\"Vélo\",\"de\":\"Fahrrad\",\"ar\":\"دراجة\"}', 1, NULL, 9, 13, 'bike', '1.00', '10.00', '11.00', '0.10', '0.20', '0.30', '0.40', '20.00', '10.00', 'percentage', '10.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-24 19:16:22', NULL),
(2, '{\"en\":\"Auto\",\"ar\":\"سيارة آلية\",\"de\":\"Auto\",\"fr\":\"Voiture\"}', 1, NULL, 6, 21, 'auto', '2.00', '12.00', '13.00', '1.00', '1.50', '1.30', '1.60', '25.00', '12.00', 'percentage', '20.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-24 19:16:59', NULL),
(3, '{\"en\":\"Car\",\"ar\":\"سيارة\",\"de\":\"Auto\",\"fr\":\"Voiture\"}', 1, NULL, 10, 11, 'car', '5.00', '15.00', '18.00', '2.00', '3.00', '3.00', '4.00', '30.00', '15.00', 'percentage', '5.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-24 19:17:16', NULL),
(4, '{\"en\":\"Prime Car\",\"de\":\"Erstklassiges Auto\",\"ar\":\"سيارة برايم\",\"fr\":\"Voiture principale\"}', 1, NULL, 29, 15, 'prime-car', '7.00', '20.00', '25.00', '3.00', '4.00', '0.00', '0.00', '40.00', '20.00', 'fixed', '35.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-23 18:08:36', NULL),
(5, '{\"en\":\"Van\"}', 2, NULL, 12, 17, 'van', '10.00', '25.00', '30.00', '4.00', '5.00', '0.00', '0.00', '50.00', '25.00', 'percentage', '4.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-23 15:59:45', NULL),
(6, '{\"en\":\"Seater SUV\",\"fr\":\"Boléro\",\"de\":\"Bolero\",\"ar\":\"بوليرو\"}', 2, NULL, 18, 19, 'seater-suv', '12.00', '28.00', '33.00', '5.00', '6.00', '3.00', '4.00', '60.00', '28.00', 'percentage', '12.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-24 20:03:53', NULL),
(7, '{\"en\":\"Ace Truck\",\"ar\":\"شوتا هاثي\",\"de\":\"Chhota-hathi\",\"fr\":\"Chhota-hathi\"}', 2, NULL, 20, 16, 'ace-truck', '15.00', '30.00', '35.00', '6.00', '7.00', '1.00', '3.00', '75.00', '30.00', 'percentage', '6.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-24 20:05:04', NULL),
(8, '{\"en\":\"Mini Truck\",\"fr\":\"Tempo\",\"ar\":\"وتيرة\",\"de\":\"Tempo\"}', 3, NULL, 26, 27, 'mini-truck', '20.00', '35.00', '40.00', '7.00', '8.00', '5.00', '9.00', '100.00', '35.00', 'percentage', '18.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-24 20:06:19', NULL),
(9, '{\"en\":\"Truck\",\"de\":\"LKW\",\"ar\":\"شاحنة\",\"fr\":\"Camion\"}', 3, NULL, 28, 14, 'truck', '30.00', '50.00', '55.00', '10.00', '12.00', '0.66', '1.20', '70.00', '50.00', 'percentage', '18.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-24 19:18:30', NULL),
(10, '{\"en\":\"Big Truck\",\"fr\":\"Gros camion\",\"de\":\"Großer LKW\",\"ar\":\"شاحنة كبيرة\"}', 3, NULL, 24, 25, 'big-truck', '50.00', '75.00', '80.00', '15.00', '18.00', '1.50', '2.50', '80.00', '60.00', 'percentage', '20.00', 1, 1, 1, '2025-01-22 18:13:08', '2025-01-24 19:18:45', NULL);

CREATE TABLE `ambulances` (
  `id` bigint UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` double DEFAULT NULL,
  `driver_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ambulances_driver_id_foreign` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambulances`
--
ALTER TABLE `ambulances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD CONSTRAINT `ambulances_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;


ALTER TABLE `rides` CHANGE `ride_number` `ride_number` BIGINT NOT NULL;


CREATE INDEX countries_name_index ON countries (name);
CREATE INDEX countries_currency_code_index ON countries (currency_code);
CREATE INDEX countries_calling_code_index ON countries (calling_code);
CREATE INDEX countries_flag_index ON countries (flag);


CREATE INDEX states_name_index ON states (name);


CREATE INDEX media_name_index ON media (name);
CREATE INDEX media_model_id_index ON media (model_id);
CREATE INDEX media_model_type_index ON media (model_type);
CREATE INDEX media_collection_name_index ON media (collection_name);
CREATE INDEX media_file_name_index ON media (file_name);
CREATE INDEX media_disk_index ON media (disk);
CREATE INDEX media_mime_type_index ON media (mime_type);


CREATE TABLE `fleet_manager_wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `fleet_manager_id` bigint UNSIGNED DEFAULT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `fleet_wallet_histories`
--

CREATE TABLE `fleet_wallet_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `fleet_wallet_id` bigint UNSIGNED DEFAULT NULL,
  `ride_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `type` enum('credit','debit') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Table structure for table `sos_alerts`
--

CREATE TABLE `sos_alerts` (
  `id` bigint UNSIGNED NOT NULL,
  `location_coordinates` json DEFAULT NULL,
  `ride_id` bigint UNSIGNED DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `sos_status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sos_statuses`
--

CREATE TABLE `sos_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sos_status_activities`
--

CREATE TABLE `sos_status_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `ride_id` bigint UNSIGNED DEFAULT NULL,
  `sos_alert_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changed_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sos_zones`
--

CREATE TABLE `sos_zones` (
  `id` bigint UNSIGNED NOT NULL,
  `s_o_s_id` bigint UNSIGNED NOT NULL,
  `zone_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fleet_withdraw_requests`
--

CREATE TABLE `fleet_withdraw_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` decimal(8,2) DEFAULT '0.00',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `fleet_wallet_id` bigint UNSIGNED DEFAULT NULL,
  `fleet_manager_id` bigint UNSIGNED DEFAULT NULL,
  `payment_type` enum('paypal','bank') COLLATE utf8mb4_unicode_ci DEFAULT 'bank',
  `is_used_by_admin` int NOT NULL DEFAULT '0',
  `is_used` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `fleet_manager_wallets`
--
ALTER TABLE `fleet_manager_wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fleet_manager_wallets_fleet_manager_id_foreign` (`fleet_manager_id`);

--
-- Indexes for table `fleet_wallet_histories`
--
ALTER TABLE `fleet_wallet_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fleet_wallet_histories_fleet_wallet_id_foreign` (`fleet_wallet_id`),
  ADD KEY `fleet_wallet_histories_from_user_id_foreign` (`from_user_id`);

--
-- Indexes for table `sos_alerts`
--
ALTER TABLE `sos_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sos_alerts_ride_id_foreign` (`ride_id`),
  ADD KEY `sos_alerts_sos_status_id_foreign` (`sos_status_id`),
  ADD KEY `sos_alerts_created_by_id_foreign` (`created_by_id`);

--
-- Indexes for table `sos_statuses`
--
ALTER TABLE `sos_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sos_statuses_created_by_id_foreign` (`created_by_id`);

--
-- Indexes for table `sos_status_activities`
--
ALTER TABLE `sos_status_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sos_status_activities_sos_alert_id_foreign` (`sos_alert_id`),
  ADD KEY `sos_status_activities_ride_id_foreign` (`ride_id`);

--
-- Indexes for table `sos_zones`
--
ALTER TABLE `sos_zones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sos_zones_s_o_s_id_foreign` (`s_o_s_id`),
  ADD KEY `sos_zones_zone_id_foreign` (`zone_id`);

--
-- Indexes for table `fleet_withdraw_requests`
--
ALTER TABLE `fleet_withdraw_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fleet_withdraw_requests_fleet_wallet_id_foreign` (`fleet_wallet_id`),
  ADD KEY `fleet_withdraw_requests_fleet_manager_id_foreign` (`fleet_manager_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fleet_manager_wallets`
--
ALTER TABLE `fleet_manager_wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fleet_wallet_histories`
--
ALTER TABLE `fleet_wallet_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sos_alerts`
--
ALTER TABLE `sos_alerts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sos_statuses`
--
ALTER TABLE `sos_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sos_status_activities`
--
ALTER TABLE `sos_status_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sos_zones`
--
ALTER TABLE `sos_zones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fleet_withdraw_requests`
--
ALTER TABLE `fleet_withdraw_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `fleet_manager_wallets`
--
ALTER TABLE `fleet_manager_wallets`
  ADD CONSTRAINT `fleet_manager_wallets_fleet_manager_id_foreign` FOREIGN KEY (`fleet_manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fleet_wallet_histories`
--
ALTER TABLE `fleet_wallet_histories`
  ADD CONSTRAINT `fleet_wallet_histories_fleet_wallet_id_foreign` FOREIGN KEY (`fleet_wallet_id`) REFERENCES `fleet_manager_wallets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fleet_wallet_histories_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sos_alerts`
--
ALTER TABLE `sos_alerts`
  ADD CONSTRAINT `sos_alerts_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sos_alerts_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sos_alerts_sos_status_id_foreign` FOREIGN KEY (`sos_status_id`) REFERENCES `sos_statuses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sos_statuses`
--
ALTER TABLE `sos_statuses`
  ADD CONSTRAINT `sos_statuses_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sos_status_activities`
--
ALTER TABLE `sos_status_activities`
  ADD CONSTRAINT `sos_status_activities_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sos_status_activities_sos_alert_id_foreign` FOREIGN KEY (`sos_alert_id`) REFERENCES `sos_alerts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sos_zones`
--
ALTER TABLE `sos_zones`
  ADD CONSTRAINT `sos_zones_s_o_s_id_foreign` FOREIGN KEY (`s_o_s_id`) REFERENCES `sos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sos_zones_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fleet_withdraw_requests`
--
ALTER TABLE `fleet_withdraw_requests`
  ADD CONSTRAINT `fleet_withdraw_requests_fleet_manager_id_foreign` FOREIGN KEY (`fleet_manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fleet_withdraw_requests_fleet_wallet_id_foreign` FOREIGN KEY (`fleet_wallet_id`) REFERENCES `fleet_manager_wallets` (`id`) ON DELETE CASCADE;

TRUNCATE `currencies`;

ALTER TABLE `currencies` ADD `flag` VARCHAR(255) NULL AFTER `code`;
INSERT INTO `currencies` (`id`, `code`, `symbol`, `flag`, `no_of_decimal`, `exchange_rate`, `symbol_position`, `thousands_separator`, `decimal_separator`, `system_reserve`, `status`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'USD', '$', 'US.png', '2.00', 1, 'before_price', 'comma', 'comma', 0, 1, 1, '2025-04-21 22:52:27', '2025-04-21 22:52:27', NULL),
(2, 'INR', '₹', 'IN.png', '2.00', 83, 'before_price', 'comma', 'comma', 0, 1, 1, '2025-04-21 22:52:27', '2025-04-21 22:52:27', NULL),
(3, 'GBP', '£', 'GB.png', '2.00', 100, 'before_price', 'comma', 'comma', 0, 1, 1, '2025-04-21 22:52:27', '2025-04-21 22:52:27', NULL),
(4, 'EUR', '€', 'AU.png', '2.00', 56, 'before_price', 'comma', 'comma', 0, 1, 1, '2025-04-21 22:52:27', '2025-04-21 22:52:27', NULL),
(5, 'BDT', 'Tk', 'BD.png', '2.00', 110.01, 'before_price', 'comma', 'comma', 0, 1, 1, '2025-04-21 22:52:27', '2025-04-21 22:52:27', NULL);

INSERT INTO `sos_statuses` (`id`, `name`, `slug`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Requested', 'requested', 1, '2025-04-15 00:32:43', '2025-04-15 00:32:43', NULL),
(2, 'Processing', 'processing', 1, '2025-04-15 00:33:43', '2025-04-15 00:33:43', NULL),
(3, 'Completed', 'completed', 1, '2025-04-15 00:33:43', '2025-04-15 00:33:43', NULL);

ALTER TABLE `zones` ADD `payment_method` JSON NULL AFTER `created_by_id`;

ALTER TABLE `vehicle_types` ADD `is_all_zones` INT NULL DEFAULT '0' AFTER `name`;

UPDATE `taxido_settings` SET `taxido_values` = '{\n    \"wallet\": {\n        \"tip_denominations\": 50,\n        \"wallet_denominations\": 50\n    },\n    \"general\": {\n        \"greetings\": [\n            \"Hello , Good Morning🌈\",\n            \"<p>🌈 Let’s make today productive and successful! 🏆</p>\"\n        ],\n        \"ride_accept\": 15,\n        \"footer_branding_hashtag\": \"#GoTaxido\",\n        \"footer_branding_attribution\": \"❤️ Made by Pixelstrap\"\n    },\n    \"setting\": {\n        \"app_version\": \"1.0.3\",\n        \"splash_screen_id\": null,\n        \"driver_app_version\": \"1.0.3\",\n        \"splash_driver_screen_id\": null\n    },\n    \"location\": {\n        \"map_provider\": \"google_map\",\n        \"radius_meter\": \"1000\",\n        \"radius_per_second\": \"10\",\n        \"google_map_api_key\": \"\"\n    },\n    \"referral\": {\n        \"interval\": \"month\",\n        \"validity\": \"3\",\n        \"referral_amount\": \"50\",\n        \"first_ride_discount\": \"30\"\n    },\n    \"activation\": {\n        \"bidding\": true,\n        \"ride_otp\": true,\n        \"parcel_otp\": true,\n        \"driver_tips\": true,\n        \"fleet_wallet\": true,\n        \"force_update\": true,\n        \"rider_wallet\": true,\n        \"cash_payments\": true,\n        \"coupon_enable\": true,\n        \"driver_wallet\": true,\n        \"online_payments\": true,\n        \"referral_enable\": true\n    },\n    \"driver_rewards\": {\n        \"status\": true,\n        \"points_per_ride\": 10\n    },\n    \"driver_commission\": {\n        \"status\": false,\n        \"min_withdraw_amount\": 500,\n        \"fleet_commission_rate\": 10,\n        \"fleet_commission_type\": \"percentage\",\n        \"ambulance_per_km_charge\": 1,\n        \"ambulance_commission_rate\": 20,\n        \"ambulance_commission_type\": \"percentage\"\n    }\n}' WHERE `taxido_settings`.`id` = 1;

UPDATE `settings` SET `values` = '{\n    \"email\": {\n        \"mail_host\": \"ENTER_YOUR_HOST\",\n        \"mail_port\": 465,\n        \"mail_mailer\": \"smtp\",\n        \"mail_password\": \"ENTER_YOUR_PASSWORD\",\n        \"mail_username\": \"ENTER_YOUR_USERNAME\",\n        \"mail_from_name\": \"no-reply\",\n        \"mailgun_domain\": \"ENTER_YOUR_MAILGUN_DOMAIN\",\n        \"mailgun_secret\": \"ENTER_YOUR_MAILGUN_SECRET\",\n        \"mail_encryption\": \"ssl\",\n        \"system_test_mail\": true,\n        \"mail_from_address\": \"ENTER_YOUR_EMAIL@MAIL.COM\",\n        \"password_reset_mail\": true\n    },\n    \"general\": {\n        \"mode\": \"light\",\n        \"site_url\": \"http://127.0.0.1:8000\",\n        \"copyright\": \"Cab Booking theme by PixelStrap\",\n        \"site_name\": \"Taxido\",\n        \"platform_fees\": 10,\n        \"currency_symbol\": \"right\",\n        \"default_timezone\": \"UTC\",\n        \"favicon_image_id\": 4,\n        \"dark_logo_image_id\": 643,\n        \"default_currency_id\": 1,\n        \"default_language_id\": 1,\n        \"default_sms_gateway\": \"twilio\",\n        \"light_logo_image_id\": 641,\n        \"admin_site_language_direction\": \"ltr\"\n    },\n    \"firebase\": {\n        \"service_json\": null\n    },\n    \"readings\": {\n        \"status\": 1,\n        \"home_page\": null\n    },\n    \"analytics\": {\n        \"facebook_pixel\": {\n            \"status\": false,\n            \"pixel_id\": \"YOUR_PIXEL_ID\"\n        },\n        \"google_analytics\": {\n            \"status\": false,\n            \"measurement_id\": \"ENTER_YOUR_SECRET_KEY\"\n        }\n    },\n    \"activation\": {\n        \"cash\": true,\n        \"demo_mode\": true,\n        \"platform_fees\": true,\n        \"preloader_enabled\": true,\n        \"default_credentials\": true,\n        \"social_login_enable\": true\n    },\n    \"appearance\": {\n        \"font_family\": \"Inter\",\n        \"primary_color\": \"#199675\",\n        \"front_font_family\": \"DM Sans\",\n        \"sidebar_solid_color\": \"#199675\",\n        \"sidebar_background_type\": \"gradient\",\n        \"sidebar_gradient_color_1\": \"#199675\",\n        \"sidebar_gradient_color_2\": \"#212121\"\n    },\n    \"app_setting\": {\n        \"app_name\": \"Taxido\",\n        \"logo_image_id\": null,\n        \"app_store_link\": \"\",\n        \"play_store_link\": \"\",\n        \"privacy_policy_link\": \"\",\n        \"term_condition_link\": \"\"\n    },\n    \"maintenance\": {\n        \"content\": \"\",\n        \"maintenance_mode\": false\n    },\n    \"social_login\": {\n        \"apple\": {\n            \"client_id\": \"\",\n            \"client_secret\": \"\"\n        },\n        \"google\": {\n            \"client_id\": \"385954585063-alkuv99a6crlch8jd8i4tfefucpd98sv.apps.googleusercontent.com\",\n            \"client_secret\": \"\"\n        },\n        \"facebook\": {\n            \"client_id\": \"\",\n            \"client_secret\": \"\"\n        }\n    },\n    \"google_reCaptcha\": {\n        \"secret\": \"ENTER_YOUR_SECRET_KEY\",\n        \"status\": false,\n        \"site_key\": \"ENTER_YOUR_SITE_KEY\"\n    },\n    \"admin_commissions\": {\n        \"status\": \"1\",\n        \"min_withdraw_amount\": 500,\n        \"default_commission_rate\": 10\n    },\n    \"media_configuration\": {\n        \"aws_bucket\": \"ENTER_YOUR_AWS_BUCKET\",\n        \"media_disk\": \"public\",\n        \"aws_access_key_id\": \"ENTER_YOUR_AWS_ACCESS_KEY\",\n        \"aws_default_region\": \"ENTER_YOUR_AWS_DEFAULT_REGION\",\n        \"aws_secret_access_key\": \"ENTER_YOUR_AWS_SECRET_KEY\"\n    }\n}' WHERE `settings`.`id` = 1;
ALTER TABLE `users` ADD `fleet_manager_id` BIGINT NULL AFTER `status`;

ALTER TABLE `cab_commission_histories`
ADD `fleet_commission` DECIMAL(8,2) NOT NULL DEFAULT '0.00'
AFTER `driver_commission`;

ALTER TABLE `ride_requests` ADD `currency_code` VARCHAR(255) NULL AFTER `payment_method`;

ALTER TABLE `rides` ADD `currency_code` VARCHAR(255) NULL AFTER `payment_method`;

ALTER TABLE `bids` CHANGE `amount` `amount` DOUBLE NULL DEFAULT NULL;

ALTER TABLE `ride_requests` ADD `currency_symbol` LONGTEXT NULL AFTER `ride_fare`;

ALTER TABLE `rides` ADD `currency_symbol` LONGTEXT NULL AFTER `total`;

SET FOREIGN_KEY_CHECKS=1;


COMMIT;
