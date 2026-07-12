SET FOREIGN_KEY_CHECKS=0;
DELETE FROM `model_has_roles`;
DELETE FROM `role_has_permissions`;
DELETE FROM `permissions`;
DELETE FROM `roles`;
DELETE FROM `modules`;
DELETE FROM `menu_items`;
DELETE FROM `migrations`;

ALTER TABLE `model_has_roles` AUTO_INCREMENT = 1;
ALTER TABLE `role_has_permissions` AUTO_INCREMENT = 1;
ALTER TABLE `permissions` AUTO_INCREMENT = 1;
ALTER TABLE `roles` AUTO_INCREMENT = 1;
ALTER TABLE `modules` AUTO_INCREMENT = 1;
ALTER TABLE `menu_items` AUTO_INCREMENT = 1;
ALTER TABLE `migrations` AUTO_INCREMENT = 1;


INSERT INTO `roles` (`id`, `name`, `guard_name`, `system_reserve`, `module`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', 1, NULL, 1, '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(2, 'user', 'web', 1, NULL, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35'),
(3, 'rider', 'web', 1, 1, 1, '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(4, 'driver', 'web', 1, 1, 1, '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(5, 'dispatcher', 'web', 1, 1, 1, '2025-10-15 12:41:41', '2025-10-15 12:41:41'),
(6, 'fleet_manager', 'web', 1, 1, 1, '2025-10-15 12:41:41', '2025-10-15 12:41:41'),
(7, 'executive', 'web', 1, 2, 1, '2025-10-15 12:41:44', '2025-10-15 12:41:44');

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'attachment.index', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(2, 'attachment.create', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(3, 'attachment.edit', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(4, 'attachment.destroy', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(5, 'attachment.restore', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(6, 'attachment.forceDelete', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(7, 'user.index', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(8, 'user.create', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(9, 'user.edit', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(10, 'user.destroy', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(11, 'user.restore', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(12, 'user.forceDelete', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(13, 'role.index', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(14, 'role.create', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(15, 'role.edit', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(16, 'role.destroy', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(17, 'category.index', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(18, 'category.create', 'web', '2025-10-15 12:41:32', '2025-10-15 12:41:32'),
(19, 'category.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(20, 'category.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(21, 'tag.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(22, 'tag.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(23, 'tag.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(24, 'tag.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(25, 'tag.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(26, 'tag.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(27, 'blog.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(28, 'blog.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(29, 'blog.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(30, 'blog.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(31, 'blog.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(32, 'blog.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(33, 'page.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(34, 'page.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(35, 'page.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(36, 'page.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(37, 'page.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(38, 'page.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(39, 'testimonial.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(40, 'testimonial.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(41, 'testimonial.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(42, 'testimonial.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(43, 'testimonial.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(44, 'testimonial.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(45, 'tax.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(46, 'tax.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(47, 'tax.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(48, 'tax.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(49, 'tax.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(50, 'tax.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(51, 'currency.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(52, 'currency.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(53, 'currency.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(54, 'currency.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(55, 'currency.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(56, 'currency.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(57, 'language.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(58, 'language.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(59, 'language.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(60, 'language.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(61, 'language.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(62, 'language.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(63, 'setting.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(64, 'setting.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(65, 'system-tool.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(66, 'system-tool.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(67, 'system-tool.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(68, 'system-tool.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(69, 'system-tool.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(70, 'system-tool.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(71, 'plugin.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(72, 'plugin.create', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(73, 'plugin.edit', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(74, 'plugin.destroy', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(75, 'plugin.restore', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(76, 'plugin.forceDelete', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(77, 'about-system.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(78, 'payment-method.index', 'web', '2025-10-15 12:41:33', '2025-10-15 12:41:33'),
(79, 'payment-method.edit', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(80, 'sms-gateway.index', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(81, 'sms-gateway.edit', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(82, 'sms_template.index', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(83, 'sms_template.create', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(84, 'sms_template.edit', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(85, 'sms_template.destroy', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(86, 'sms_template.forceDelete', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(87, 'email_template.index', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(88, 'email_template.create', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(89, 'email_template.destroy', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(90, 'email_template.edit', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(91, 'email_template.forceDelete', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(92, 'push_notification_template.index', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(93, 'push_notification_template.create', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(94, 'push_notification_template.destroy', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(95, 'push_notification_template.edit', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(96, 'push_notification_template.forceDelete', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(97, 'landing_page.index', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(98, 'landing_page.edit', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(99, 'appearance.index', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(100, 'appearance.edit', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(101, 'appearance.create', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(102, 'backup.index', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(103, 'backup.create', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(104, 'backup.edit', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(105, 'backup.destroy', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(106, 'backup.restore', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(107, 'backup.forceDelete', 'web', '2025-10-15 12:41:34', '2025-10-15 12:41:34'),
(109, 'rider.create', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(110, 'rider.edit', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(111, 'rider.destroy', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(112, 'rider.restore', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(113, 'rider.forceDelete', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(114, 'driver.index', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(115, 'driver.create', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(116, 'driver.edit', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(117, 'driver.destroy', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(118, 'driver.restore', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(119, 'driver.forceDelete', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(120, 'dispatcher.index', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(121, 'dispatcher.create', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(122, 'dispatcher.edit', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(123, 'dispatcher.destroy', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(124, 'dispatcher.restore', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(125, 'dispatcher.forceDelete', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(126, 'unverified_driver.index', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(127, 'unverified_driver.create', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(128, 'unverified_driver.edit', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(129, 'unverified_driver.destroy', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(130, 'unverified_driver.restore', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(131, 'unverified_driver.forceDelete', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(132, 'banner.index', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(133, 'banner.create', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(134, 'banner.edit', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(135, 'banner.destroy', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(136, 'banner.restore', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(137, 'banner.forceDelete', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(138, 'document.index', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(139, 'document.create', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(140, 'document.edit', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(141, 'document.destroy', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(142, 'document.restore', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(143, 'document.forceDelete', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(144, 'vehicle_type.index', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(145, 'vehicle_type.create', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(146, 'vehicle_type.edit', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(147, 'vehicle_type.destroy', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(148, 'vehicle_type.restore', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(149, 'vehicle_type.forceDelete', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(150, 'coupon.index', 'web', '2025-10-15 12:41:37', '2025-10-15 12:41:37'),
(151, 'coupon.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(152, 'coupon.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(153, 'coupon.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(154, 'coupon.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(155, 'coupon.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(156, 'zone.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(157, 'zone.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(158, 'zone.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(159, 'zone.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(160, 'zone.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(161, 'zone.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(162, 'faq.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(163, 'faq.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(164, 'faq.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(165, 'faq.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(166, 'faq.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(167, 'faq.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(168, 'heat_map.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(169, 'heat_map.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(170, 'heat_map.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(171, 'heat_map.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(172, 'heat_map.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(173, 'heat_map.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(174, 'sos.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(175, 'sos.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(176, 'sos.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(177, 'sos.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(178, 'sos.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(179, 'sos.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(180, 'driver_document.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(181, 'driver_document.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(182, 'driver_document.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(183, 'driver_document.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(184, 'driver_document.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(185, 'driver_document.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(186, 'driver_rule.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(187, 'driver_rule.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(188, 'driver_rule.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(189, 'driver_rule.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(190, 'driver_rule.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(191, 'driver_rule.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(192, 'extra_charge.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(193, 'extra_charge.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(194, 'extra_charge.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(195, 'extra_charge.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(196, 'extra_charge.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(197, 'extra_charge.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(198, 'cab_commission_history.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(199, 'notice.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(200, 'notice.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(201, 'notice.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(202, 'notice.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(203, 'notice.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(204, 'notice.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(205, 'driver_wallet.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(206, 'driver_wallet.credit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(207, 'driver_wallet.debit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(208, 'service.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(209, 'service.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(210, 'onboarding.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(211, 'onboarding.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(212, 'service_category.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(213, 'service_category.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(214, 'taxido_setting.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(215, 'taxido_setting.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(216, 'ride_request.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(217, 'ride_request.create', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(218, 'ride_request.edit', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(219, 'ride_request.destroy', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(220, 'ride_request.restore', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(221, 'ride_request.forceDelete', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(222, 'ride.index', 'web', '2025-10-15 12:41:38', '2025-10-15 12:41:38'),
(223, 'ride.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(224, 'ride.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(225, 'plan.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(226, 'plan.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(227, 'plan.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(228, 'plan.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(229, 'plan.restore', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(230, 'plan.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(231, 'airport.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(232, 'airport.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(233, 'airport.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(234, 'airport.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(235, 'airport.restore', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(236, 'airport.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(237, 'surge_price.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(238, 'surge_price.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(239, 'surge_price.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(240, 'surge_price.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(241, 'surge_price.restore', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(242, 'surge_price.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(243, 'subscription.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(244, 'subscription.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(245, 'subscription.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(246, 'subscription.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(247, 'subscription.purchase', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(248, 'subscription.cancel', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(249, 'bid.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(250, 'bid.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(251, 'bid.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(252, 'push_notification.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(253, 'push_notification.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(254, 'push_notification.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(255, 'push_notification.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(256, 'rider_wallet.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(257, 'rider_wallet.credit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(258, 'rider_wallet.debit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(259, 'withdraw_request.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(260, 'withdraw_request.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(261, 'withdraw_request.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(262, 'fleet_withdraw_request.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(263, 'fleet_withdraw_request.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(264, 'fleet_withdraw_request.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(265, 'report.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(266, 'report.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(267, 'driver_location.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(268, 'driver_location.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(269, 'cancellation_reason.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(270, 'cancellation_reason.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(271, 'cancellation_reason.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(272, 'cancellation_reason.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(273, 'cancellation_reason.restore', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(274, 'cancellation_reason.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(275, 'driver_review.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(276, 'driver_review.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(277, 'driver_review.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(278, 'driver_review.restore', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(279, 'driver_review.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(280, 'rider_review.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(281, 'rider_review.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(282, 'rider_review.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(283, 'rider_review.restore', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(284, 'rider_review.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(285, 'hourly_package.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(286, 'hourly_package.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(287, 'hourly_package.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(288, 'hourly_package.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(289, 'hourly_package.restore', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(290, 'hourly_package.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(291, 'sos_alert.index', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(292, 'sos_alert.create', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(293, 'sos_alert.edit', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(294, 'sos_alert.destroy', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(295, 'sos_alert.restore', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(296, 'sos_alert.forceDelete', 'web', '2025-10-15 12:41:39', '2025-10-15 12:41:39'),
(297, 'rental_vehicle.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(298, 'rental_vehicle.create', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(299, 'rental_vehicle.edit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(300, 'rental_vehicle.destroy', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(301, 'rental_vehicle.restore', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(302, 'rental_vehicle.forceDelete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(303, 'fleet_manager.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(304, 'fleet_manager.create', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(305, 'fleet_manager.edit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(306, 'fleet_manager.destroy', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(307, 'fleet_manager.restore', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(308, 'fleet_manager.forceDelete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(309, 'fleet_wallet.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(310, 'fleet_wallet.credit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(311, 'fleet_wallet.debit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(312, 'chat.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(313, 'chat.send', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(314, 'chat.replay', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(315, 'chat.delete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(316, 'ambulance.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(317, 'fleet_document.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(318, 'fleet_document.create', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(319, 'fleet_document.edit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(320, 'fleet_document.destroy', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(321, 'fleet_document.restore', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(322, 'fleet_document.forceDelete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(323, 'fleet_vehicle_document.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(324, 'fleet_vehicle_document.create', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(325, 'fleet_vehicle_document.edit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(326, 'fleet_vehicle_document.destroy', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(327, 'fleet_vehicle_document.restore', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(328, 'fleet_vehicle_document.forceDelete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(329, 'vehicle_info.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(330, 'vehicle_info.create', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(331, 'vehicle_info.edit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(332, 'vehicle_info.destroy', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(333, 'vehicle_info.restore', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(334, 'vehicle_info.forceDelete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(335, 'peak_zone.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(336, 'peak_zone.create', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(337, 'peak_zone.edit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(338, 'peak_zone.destroy', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(339, 'peak_zone.restore', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(340, 'peak_zone.forceDelete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(341, 'preference.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(342, 'preference.create', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(343, 'preference.edit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(344, 'preference.destroy', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(345, 'preference.restore', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(346, 'preference.forceDelete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(347, 'cab_referral.index', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(348, 'cab_referral.create', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(349, 'cab_referral.edit', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(350, 'cab_referral.destroy', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(351, 'cab_referral.restore', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(352, 'cab_referral.forceDelete', 'web', '2025-10-15 12:41:40', '2025-10-15 12:41:40'),
(353, 'ticket.ticket.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(354, 'ticket.ticket.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(355, 'ticket.ticket.reply', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(356, 'ticket.ticket.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(357, 'ticket.ticket.restore', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(358, 'ticket.ticket.forceDelete', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(359, 'ticket.priority.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(360, 'ticket.priority.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(361, 'ticket.priority.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(362, 'ticket.priority.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(363, 'ticket.priority.restore', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(364, 'ticket.priority.forceDelete', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(365, 'ticket.executive.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(366, 'ticket.executive.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(367, 'ticket.executive.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(368, 'ticket.executive.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(369, 'ticket.executive.restore', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(370, 'ticket.executive.forceDelete', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(371, 'ticket.department.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(372, 'ticket.department.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(373, 'ticket.department.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(374, 'ticket.department.show', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(375, 'ticket.department.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(376, 'ticket.department.restore', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(377, 'ticket.department.forceDelete', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(378, 'ticket.formfield.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(379, 'ticket.formfield.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(380, 'ticket.formfield.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(381, 'ticket.formfield.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(382, 'ticket.formfield.restore', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(383, 'ticket.formfield.forceDelete', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(384, 'ticket.status.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(385, 'ticket.status.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(386, 'ticket.status.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(387, 'ticket.status.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(388, 'ticket.status.restore', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(389, 'ticket.status.forceDelete', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(390, 'ticket.knowledge.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(391, 'ticket.knowledge.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(392, 'ticket.knowledge.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(393, 'ticket.knowledge.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(394, 'ticket.knowledge.restore', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(395, 'ticket.knowledge.forceDelete', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(396, 'ticket.category.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(397, 'ticket.category.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(398, 'ticket.category.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(399, 'ticket.category.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(400, 'ticket.tag.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(401, 'ticket.tag.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(402, 'ticket.tag.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(403, 'ticket.tag.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(404, 'ticket.tag.restore', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(405, 'ticket.tag.forceDelete', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(406, 'ticket.setting.index', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(407, 'ticket.setting.create', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(408, 'ticket.setting.edit', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(409, 'ticket.setting.destroy', 'web', '2025-10-15 12:41:43', '2025-10-15 12:41:43'),
(410, 'ticket.setting.restore', 'web', '2025-10-15 12:41:44', '2025-10-15 12:41:44'),
(411, 'ticket.setting.forceDelete', 'web', '2025-10-15 12:41:44', '2025-10-15 12:41:44');

INSERT INTO `modules` (`id`, `name`, `actions`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'attachments', '{\"index\":\"attachment.index\",\"create\":\"attachment.create\",\"edit\":\"attachment.edit\",\"trash\":\"attachment.destroy\",\"restore\":\"attachment.restore\",\"delete\":\"attachment.forceDelete\"}', '2025-10-15 12:41:32', '2025-10-15 12:41:32', NULL),
(2, 'users', '{\"index\":\"user.index\",\"create\":\"user.create\",\"edit\":\"user.edit\",\"trash\":\"user.destroy\",\"restore\":\"user.restore\",\"delete\":\"user.forceDelete\"}', '2025-10-15 12:41:32', '2025-10-15 12:41:32', NULL),
(3, 'roles', '{\"index\":\"role.index\",\"create\":\"role.create\",\"edit\":\"role.edit\",\"delete\":\"role.destroy\"}', '2025-10-15 12:41:32', '2025-10-15 12:41:32', NULL),
(4, 'categories', '{\"index\":\"category.index\",\"create\":\"category.create\",\"edit\":\"category.edit\",\"delete\":\"category.destroy\"}', '2025-10-15 12:41:32', '2025-10-15 12:41:32', NULL),
(5, 'tags', '{\"index\":\"tag.index\",\"create\":\"tag.create\",\"edit\":\"tag.edit\",\"trash\":\"tag.destroy\",\"restore\":\"tag.restore\",\"delete\":\"tag.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(6, 'blogs', '{\"index\":\"blog.index\",\"create\":\"blog.create\",\"edit\":\"blog.edit\",\"trash\":\"blog.destroy\",\"restore\":\"blog.restore\",\"delete\":\"blog.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(7, 'pages', '{\"index\":\"page.index\",\"create\":\"page.create\",\"edit\":\"page.edit\",\"trash\":\"page.destroy\",\"restore\":\"page.restore\",\"delete\":\"page.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(8, 'testimonials', '{\"index\":\"testimonial.index\",\"create\":\"testimonial.create\",\"edit\":\"testimonial.edit\",\"trash\":\"testimonial.destroy\",\"restore\":\"testimonial.restore\",\"delete\":\"testimonial.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(9, 'taxes', '{\"index\":\"tax.index\",\"create\":\"tax.create\",\"edit\":\"tax.edit\",\"trash\":\"tax.destroy\",\"restore\":\"tax.restore\",\"delete\":\"tax.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(10, 'currencies', '{\"index\":\"currency.index\",\"create\":\"currency.create\",\"edit\":\"currency.edit\",\"trash\":\"currency.destroy\",\"restore\":\"currency.restore\",\"delete\":\"currency.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(11, 'languages', '{\"index\":\"language.index\",\"create\":\"language.create\",\"edit\":\"language.edit\",\"trash\":\"language.destroy\",\"restore\":\"language.restore\",\"delete\":\"language.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(12, 'settings', '{\"index\":\"setting.index\",\"edit\":\"setting.edit\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(13, 'system-tools', '{\"index\":\"system-tool.index\",\"create\":\"system-tool.create\",\"edit\":\"system-tool.edit\",\"trash\":\"system-tool.destroy\",\"restore\":\"system-tool.restore\",\"delete\":\"system-tool.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(14, 'plugins', '{\"index\":\"plugin.index\",\"create\":\"plugin.create\",\"edit\":\"plugin.edit\",\"trash\":\"plugin.destroy\",\"restore\":\"plugin.restore\",\"delete\":\"plugin.forceDelete\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(15, 'about-system', '{\"index\":\"about-system.index\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(16, 'payment-methods', '{\"index\":\"payment-method.index\",\"edit\":\"payment-method.edit\"}', '2025-10-15 12:41:33', '2025-10-15 12:41:33', NULL),
(17, 'sms-gateways', '{\"index\":\"sms-gateway.index\",\"edit\":\"sms-gateway.edit\"}', '2025-10-15 12:41:34', '2025-10-15 12:41:34', NULL),
(18, 'sms_templates', '{\"index\":\"sms_template.index\",\"create\":\"sms_template.create\",\"edit\":\"sms_template.edit\",\"trash\":\"sms_template.destroy\",\"delete\":\"sms_template.forceDelete\"}', '2025-10-15 12:41:34', '2025-10-15 12:41:34', NULL),
(19, 'email_templates', '{\"index\":\"email_template.index\",\"create\":\"email_template.create\",\"trash\":\"email_template.destroy\",\"edit\":\"email_template.edit\",\"delete\":\"email_template.forceDelete\"}', '2025-10-15 12:41:34', '2025-10-15 12:41:34', NULL),
(20, 'push_notification_templates', '{\"index\":\"push_notification_template.index\",\"create\":\"push_notification_template.create\",\"trash\":\"push_notification_template.destroy\",\"edit\":\"push_notification_template.edit\",\"delete\":\"push_notification_template.forceDelete\"}', '2025-10-15 12:41:34', '2025-10-15 12:41:34', NULL),
(21, 'landing_page', '{\"index\":\"landing_page.index\",\"edit\":\"landing_page.edit\"}', '2025-10-15 12:41:34', '2025-10-15 12:41:34', NULL),
(22, 'appearance', '{\"index\":\"appearance.index\",\"edit\":\"appearance.edit\",\"create\":\"appearance.create\"}', '2025-10-15 12:41:34', '2025-10-15 12:41:34', NULL),
(23, 'backups', '{\"index\":\"backup.index\",\"create\":\"backup.create\",\"edit\":\"backup.edit\",\"trash\":\"backup.destroy\",\"restore\":\"backup.restore\",\"delete\":\"backup.forceDelete\"}', '2025-10-15 12:41:34', '2025-10-15 12:41:34', NULL),

(25, 'drivers', '{\"index\":\"driver.index\",\"create\":\"driver.create\",\"edit\":\"driver.edit\",\"trash\":\"driver.destroy\",\"restore\":\"driver.restore\",\"delete\":\"driver.forceDelete\"}', '2025-10-15 12:41:37', '2025-10-15 12:41:37', NULL),
(26, 'dispatchers', '{\"index\":\"dispatcher.index\",\"create\":\"dispatcher.create\",\"edit\":\"dispatcher.edit\",\"trash\":\"dispatcher.destroy\",\"restore\":\"dispatcher.restore\",\"delete\":\"dispatcher.forceDelete\"}', '2025-10-15 12:41:37', '2025-10-15 12:41:37', NULL),
(27, 'unverified_drivers', '{\"index\":\"unverified_driver.index\",\"create\":\"unverified_driver.create\",\"edit\":\"unverified_driver.edit\",\"trash\":\"unverified_driver.destroy\",\"restore\":\"unverified_driver.restore\",\"delete\":\"unverified_driver.forceDelete\"}', '2025-10-15 12:41:37', '2025-10-15 12:41:37', NULL),
(28, 'banners', '{\"index\":\"banner.index\",\"create\":\"banner.create\",\"edit\":\"banner.edit\",\"trash\":\"banner.destroy\",\"restore\":\"banner.restore\",\"delete\":\"banner.forceDelete\"}', '2025-10-15 12:41:37', '2025-10-15 12:41:37', NULL),
(29, 'documents', '{\"index\":\"document.index\",\"create\":\"document.create\",\"edit\":\"document.edit\",\"trash\":\"document.destroy\",\"restore\":\"document.restore\",\"delete\":\"document.forceDelete\"}', '2025-10-15 12:41:37', '2025-10-15 12:41:37', NULL),
(30, 'vehicle_types', '{\"index\":\"vehicle_type.index\",\"create\":\"vehicle_type.create\",\"edit\":\"vehicle_type.edit\",\"trash\":\"vehicle_type.destroy\",\"restore\":\"vehicle_type.restore\",\"delete\":\"vehicle_type.forceDelete\"}', '2025-10-15 12:41:37', '2025-10-15 12:41:37', NULL),
(31, 'coupons', '{\"index\":\"coupon.index\",\"create\":\"coupon.create\",\"edit\":\"coupon.edit\",\"trash\":\"coupon.destroy\",\"restore\":\"coupon.restore\",\"delete\":\"coupon.forceDelete\"}', '2025-10-15 12:41:37', '2025-10-15 12:41:37', NULL),
(32, 'zones', '{\"index\":\"zone.index\",\"create\":\"zone.create\",\"edit\":\"zone.edit\",\"trash\":\"zone.destroy\",\"restore\":\"zone.restore\",\"delete\":\"zone.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(33, 'faqs', '{\"index\":\"faq.index\",\"create\":\"faq.create\",\"edit\":\"faq.edit\",\"trash\":\"faq.destroy\",\"restore\":\"faq.restore\",\"delete\":\"faq.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(34, 'heatmaps', '{\"index\":\"heat_map.index\",\"create\":\"heat_map.create\",\"edit\":\"heat_map.edit\",\"trash\":\"heat_map.destroy\",\"restore\":\"heat_map.restore\",\"delete\":\"heat_map.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(35, 'soses', '{\"index\":\"sos.index\",\"create\":\"sos.create\",\"edit\":\"sos.edit\",\"trash\":\"sos.destroy\",\"restore\":\"sos.restore\",\"delete\":\"sos.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(36, 'driver_documents', '{\"index\":\"driver_document.index\",\"create\":\"driver_document.create\",\"edit\":\"driver_document.edit\",\"trash\":\"driver_document.destroy\",\"restore\":\"driver_document.restore\",\"delete\":\"driver_document.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(37, 'driver_rules', '{\"index\":\"driver_rule.index\",\"create\":\"driver_rule.create\",\"edit\":\"driver_rule.edit\",\"trash\":\"driver_rule.destroy\",\"restore\":\"driver_rule.restore\",\"delete\":\"driver_rule.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(38, 'extra_charges', '{\"index\":\"extra_charge.index\",\"create\":\"extra_charge.create\",\"edit\":\"extra_charge.edit\",\"trash\":\"extra_charge.destroy\",\"restore\":\"extra_charge.restore\",\"delete\":\"extra_charge.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(39, 'cab_commission_histories', '{\"index\":\"cab_commission_history.index\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(40, 'notices', '{\"index\":\"notice.index\",\"create\":\"notice.create\",\"edit\":\"notice.edit\",\"trash\":\"notice.destroy\",\"restore\":\"notice.restore\",\"delete\":\"notice.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(41, 'driver_wallets', '{\"index\":\"driver_wallet.index\",\"credit\":\"driver_wallet.credit\",\"debit\":\"driver_wallet.debit\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(42, 'services', '{\"index\":\"service.index\",\"edit\":\"service.edit\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(43, 'onboardings', '{\"index\":\"onboarding.index\",\"edit\":\"onboarding.edit\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(44, 'service_categories', '{\"index\":\"service_category.index\",\"edit\":\"service_category.edit\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(45, 'taxido_settings', '{\"index\":\"taxido_setting.index\",\"edit\":\"taxido_setting.edit\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(46, 'ride_request', '{\"index\":\"ride_request.index\",\"create\":\"ride_request.create\",\"edit\":\"ride_request.edit\",\"trash\":\"ride_request.destroy\",\"restore\":\"ride_request.restore\",\"delete\":\"ride_request.forceDelete\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(47, 'rides', '{\"index\":\"ride.index\",\"create\":\"ride.create\",\"edit\":\"ride.edit\"}', '2025-10-15 12:41:38', '2025-10-15 12:41:38', NULL),
(48, 'plans', '{\"index\":\"plan.index\",\"create\":\"plan.create\",\"edit\":\"plan.edit\",\"trash\":\"plan.destroy\",\"restore\":\"plan.restore\",\"delete\":\"plan.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(49, 'airports', '{\"index\":\"airport.index\",\"create\":\"airport.create\",\"edit\":\"airport.edit\",\"trash\":\"airport.destroy\",\"restore\":\"airport.restore\",\"delete\":\"airport.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(50, 'surge_prices', '{\"index\":\"surge_price.index\",\"create\":\"surge_price.create\",\"edit\":\"surge_price.edit\",\"trash\":\"surge_price.destroy\",\"restore\":\"surge_price.restore\",\"delete\":\"surge_price.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(51, 'subscriptions', '{\"index\":\"subscription.index\",\"create\":\"subscription.create\",\"edit\":\"subscription.edit\",\"destroy\":\"subscription.destroy\",\"purchase\":\"subscription.purchase\",\"cancel\":\"subscription.cancel\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(52, 'bids', '{\"index\":\"bid.index\",\"create\":\"bid.create\",\"edit\":\"bid.edit\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(53, 'push_notifications', '{\"index\":\"push_notification.index\",\"create\":\"push_notification.create\",\"trash\":\"push_notification.destroy\",\"delete\":\"push_notification.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(54, 'rider_wallets', '{\"index\":\"rider_wallet.index\",\"credit\":\"rider_wallet.credit\",\"debit\":\"rider_wallet.debit\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(55, 'withdraw_requests', '{\"index\":\"withdraw_request.index\",\"create\":\"withdraw_request.create\",\"edit\":\"withdraw_request.edit\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(56, 'fleet_withdraw_requests', '{\"index\":\"fleet_withdraw_request.index\",\"create\":\"fleet_withdraw_request.create\",\"edit\":\"fleet_withdraw_request.edit\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(57, 'reports', '{\"index\":\"report.index\",\"create\":\"report.create\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(58, 'driver_locations', '{\"index\":\"driver_location.index\",\"create\":\"driver_location.create\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(59, 'cancellation_reasons', '{\"index\":\"cancellation_reason.index\",\"create\":\"cancellation_reason.create\",\"edit\":\"cancellation_reason.edit\",\"trash\":\"cancellation_reason.destroy\",\"restore\":\"cancellation_reason.restore\",\"delete\":\"cancellation_reason.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(60, 'driver_reviews', '{\"index\":\"driver_review.index\",\"create\":\"driver_review.create\",\"trash\":\"driver_review.destroy\",\"restore\":\"driver_review.restore\",\"delete\":\"driver_review.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(61, 'rider_reviews', '{\"index\":\"rider_review.index\",\"create\":\"rider_review.create\",\"trash\":\"rider_review.destroy\",\"restore\":\"rider_review.restore\",\"delete\":\"rider_review.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(62, 'hourly_packages', '{\"index\":\"hourly_package.index\",\"create\":\"hourly_package.create\",\"edit\":\"hourly_package.edit\",\"trash\":\"hourly_package.destroy\",\"restore\":\"hourly_package.restore\",\"delete\":\"hourly_package.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(63, 'sos_alerts', '{\"index\":\"sos_alert.index\",\"create\":\"sos_alert.create\",\"edit\":\"sos_alert.edit\",\"trash\":\"sos_alert.destroy\",\"restore\":\"sos_alert.restore\",\"delete\":\"sos_alert.forceDelete\"}', '2025-10-15 12:41:39', '2025-10-15 12:41:39', NULL),
(64, 'rental_vehicles', '{\"index\":\"rental_vehicle.index\",\"create\":\"rental_vehicle.create\",\"edit\":\"rental_vehicle.edit\",\"trash\":\"rental_vehicle.destroy\",\"restore\":\"rental_vehicle.restore\",\"delete\":\"rental_vehicle.forceDelete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(65, 'fleet_managers', '{\"index\":\"fleet_manager.index\",\"create\":\"fleet_manager.create\",\"edit\":\"fleet_manager.edit\",\"trash\":\"fleet_manager.destroy\",\"restore\":\"fleet_manager.restore\",\"delete\":\"fleet_manager.forceDelete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(66, 'fleet_wallets', '{\"index\":\"fleet_wallet.index\",\"credit\":\"fleet_wallet.credit\",\"debit\":\"fleet_wallet.debit\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(67, 'chats', '{\"index\":\"chat.index\",\"send\":\"chat.send\",\"reply\":\"chat.replay\",\"delete\":\"chat.delete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(68, 'ambulances', '{\"index\":\"ambulance.index\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(69, 'fleet_documents', '{\"index\":\"fleet_document.index\",\"create\":\"fleet_document.create\",\"edit\":\"fleet_document.edit\",\"trash\":\"fleet_document.destroy\",\"restore\":\"fleet_document.restore\",\"delete\":\"fleet_document.forceDelete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(70, 'fleet_vehicle_documents', '{\"index\":\"fleet_vehicle_document.index\",\"create\":\"fleet_vehicle_document.create\",\"edit\":\"fleet_vehicle_document.edit\",\"trash\":\"fleet_vehicle_document.destroy\",\"restore\":\"fleet_vehicle_document.restore\",\"delete\":\"fleet_vehicle_document.forceDelete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(71, 'vehicle_info', '{\"index\":\"vehicle_info.index\",\"create\":\"vehicle_info.create\",\"edit\":\"vehicle_info.edit\",\"trash\":\"vehicle_info.destroy\",\"restore\":\"vehicle_info.restore\",\"delete\":\"vehicle_info.forceDelete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(72, 'peak_zones', '{\"index\":\"peak_zone.index\",\"create\":\"peak_zone.create\",\"edit\":\"peak_zone.edit\",\"trash\":\"peak_zone.destroy\",\"restore\":\"peak_zone.restore\",\"delete\":\"peak_zone.forceDelete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(73, 'preferences', '{\"index\":\"preference.index\",\"create\":\"preference.create\",\"edit\":\"preference.edit\",\"trash\":\"preference.destroy\",\"restore\":\"preference.restore\",\"delete\":\"preference.forceDelete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(74, 'cab_referrals', '{\"index\":\"cab_referral.index\",\"create\":\"cab_referral.create\",\"edit\":\"cab_referral.edit\",\"trash\":\"cab_referral.destroy\",\"restore\":\"cab_referral.restore\",\"delete\":\"cab_referral.forceDelete\"}', '2025-10-15 12:41:40', '2025-10-15 12:41:40', NULL),
(75, 'tickets', '{\"index\":\"ticket.ticket.index\",\"create\":\"ticket.ticket.create\",\"reply\":\"ticket.ticket.reply\",\"trash\":\"ticket.ticket.destroy\",\"restore\":\"ticket.ticket.restore\",\"delete\":\"ticket.ticket.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(76, 'priorities', '{\"index\":\"ticket.priority.index\",\"create\":\"ticket.priority.create\",\"edit\":\"ticket.priority.edit\",\"trash\":\"ticket.priority.destroy\",\"restore\":\"ticket.priority.restore\",\"delete\":\"ticket.priority.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(77, 'executives', '{\"index\":\"ticket.executive.index\",\"create\":\"ticket.executive.create\",\"edit\":\"ticket.executive.edit\",\"trash\":\"ticket.executive.destroy\",\"restore\":\"ticket.executive.restore\",\"delete\":\"ticket.executive.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(78, 'departments', '{\"index\":\"ticket.department.index\",\"create\":\"ticket.department.create\",\"edit\":\"ticket.department.edit\",\"show\":\"ticket.department.show\",\"trash\":\"ticket.department.destroy\",\"restore\":\"ticket.department.restore\",\"delete\":\"ticket.department.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(79, 'formfields', '{\"index\":\"ticket.formfield.index\",\"create\":\"ticket.formfield.create\",\"edit\":\"ticket.formfield.edit\",\"trash\":\"ticket.formfield.destroy\",\"restore\":\"ticket.formfield.restore\",\"delete\":\"ticket.formfield.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(80, 'statuses', '{\"index\":\"ticket.status.index\",\"create\":\"ticket.status.create\",\"edit\":\"ticket.status.edit\",\"trash\":\"ticket.status.destroy\",\"restore\":\"ticket.status.restore\",\"delete\":\"ticket.status.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(81, 'knowledge', '{\"index\":\"ticket.knowledge.index\",\"create\":\"ticket.knowledge.create\",\"edit\":\"ticket.knowledge.edit\",\"trash\":\"ticket.knowledge.destroy\",\"restore\":\"ticket.knowledge.restore\",\"delete\":\"ticket.knowledge.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(82, 'knowledge_categories', '{\"index\":\"ticket.category.index\",\"create\":\"ticket.category.create\",\"edit\":\"ticket.category.edit\",\"delete\":\"ticket.category.destroy\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(83, 'knowledge_tags', '{\"index\":\"ticket.tag.index\",\"create\":\"ticket.tag.create\",\"edit\":\"ticket.tag.edit\",\"trash\":\"ticket.tag.destroy\",\"restore\":\"ticket.tag.restore\",\"delete\":\"ticket.tag.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL),
(84, 'ticket_settings', '{\"index\":\"ticket.setting.index\",\"create\":\"ticket.setting.create\",\"edit\":\"ticket.setting.edit\",\"trash\":\"ticket.setting.destroy\",\"restore\":\"ticket.setting.restore\",\"delete\":\"ticket.setting.forceDelete\"}', '2025-10-15 12:41:43', '2025-10-15 12:41:43', NULL);


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
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(198, 1),
(199, 1),
(200, 1),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(205, 1),
(206, 1),
(207, 1),
(208, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(213, 1),
(214, 1),
(215, 1),
(216, 1),
(217, 1),
(218, 1),
(219, 1),
(220, 1),
(221, 1),
(222, 1),
(223, 1),
(224, 1),
(225, 1),
(226, 1),
(227, 1),
(228, 1),
(229, 1),
(230, 1),
(231, 1),
(232, 1),
(233, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(238, 1),
(239, 1),
(240, 1),
(241, 1),
(242, 1),
(243, 1),
(244, 1),
(245, 1),
(246, 1),
(247, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(253, 1),
(254, 1),
(255, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(263, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1),
(268, 1),
(269, 1),
(270, 1),
(271, 1),
(272, 1),
(273, 1),
(274, 1),
(275, 1),
(276, 1),
(277, 1),
(278, 1),
(279, 1),
(280, 1),
(281, 1),
(282, 1),
(283, 1),
(284, 1),
(285, 1),
(286, 1),
(287, 1),
(288, 1),
(289, 1),
(290, 1),
(291, 1),
(292, 1),
(293, 1),
(294, 1),
(295, 1),
(296, 1),
(297, 1),
(298, 1),
(299, 1),
(300, 1),
(301, 1),
(302, 1),
(303, 1),
(304, 1),
(305, 1),
(306, 1),
(307, 1),
(308, 1),
(309, 1),
(310, 1),
(311, 1),
(312, 1),
(313, 1),
(314, 1),
(315, 1),
(316, 1),
(317, 1),
(318, 1),
(319, 1),
(320, 1),
(321, 1),
(322, 1),
(323, 1),
(324, 1),
(325, 1),
(326, 1),
(327, 1),
(328, 1),
(329, 1),
(330, 1),
(331, 1),
(332, 1),
(333, 1),
(334, 1),
(335, 1),
(336, 1),
(337, 1),
(338, 1),
(339, 1),
(340, 1),
(341, 1),
(342, 1),
(343, 1),
(344, 1),
(345, 1),
(346, 1),
(347, 1),
(348, 1),
(349, 1),
(350, 1),
(351, 1),
(352, 1),
(353, 1),
(354, 1),
(355, 1),
(356, 1),
(357, 1),
(358, 1),
(359, 1),
(360, 1),
(361, 1),
(362, 1),
(363, 1),
(364, 1),
(365, 1),
(366, 1),
(367, 1),
(368, 1),
(369, 1),
(370, 1),
(371, 1),
(372, 1),
(373, 1),
(374, 1),
(375, 1),
(376, 1),
(377, 1),
(378, 1),
(379, 1),
(380, 1),
(381, 1),
(382, 1),
(383, 1),
(384, 1),
(385, 1),
(386, 1),
(387, 1),
(388, 1),
(389, 1),
(390, 1),
(391, 1),
(392, 1),
(393, 1),
(394, 1),
(395, 1),
(396, 1),
(397, 1),
(398, 1),
(399, 1),
(400, 1),
(401, 1),
(402, 1),
(403, 1),
(404, 1),
(405, 1),
(406, 1),
(407, 1),
(408, 1),
(409, 1),
(410, 1),
(411, 1),
(17, 2),
(21, 2),
(27, 2),
(33, 2),
(39, 2),
(45, 2),
(51, 2),
(57, 2),
(102, 2),
(353, 2),
(354, 2),
(355, 2),
(356, 2),
(357, 2),
(358, 2),
(390, 2),
(396, 2),
(400, 2),
(108, 3),
(120, 3),
(132, 3),
(138, 3),
(144, 3),
(150, 3),
(174, 3),
(208, 3),
(212, 3),
(216, 3),
(217, 3),
(218, 3),
(219, 3),
(222, 3),
(223, 3),
(224, 3),
(249, 3),
(251, 3),
(256, 3),
(269, 3),
(275, 3),
(276, 3),
(280, 3),
(285, 3),
(291, 3),
(297, 3),
(312, 3),
(313, 3),
(314, 3),
(315, 3),
(316, 3),
(347, 3),
(114, 4),
(116, 4),
(138, 4),
(144, 4),
(168, 4),
(174, 4),
(180, 4),
(181, 4),
(186, 4),
(192, 4),
(198, 4),
(205, 4),
(208, 4),
(212, 4),
(216, 4),
(218, 4),
(222, 4),
(224, 4),
(225, 4),
(231, 4),
(237, 4),
(243, 4),
(247, 4),
(248, 4),
(249, 4),
(250, 4),
(259, 4),
(260, 4),
(275, 4),
(280, 4),
(281, 4),
(285, 4),
(291, 4),
(297, 4),
(298, 4),
(299, 4),
(300, 4),
(301, 4),
(302, 4),
(303, 4),
(312, 4),
(313, 4),
(314, 4),
(315, 4),
(316, 4),
(317, 4),
(318, 4),
(323, 4),
(324, 4),
(329, 4),
(335, 4),
(341, 4),
(114, 5),
(116, 5),
(120, 5),
(122, 5),
(126, 5),
(144, 5),
(156, 5),
(168, 5),
(208, 5),
(212, 5),
(216, 5),
(218, 5),
(219, 5),
(220, 5),
(222, 5),
(224, 5),
(267, 5),
(269, 5),
(316, 5),
(335, 5),
(114, 6),
(144, 6),
(156, 6),
(168, 6),
(180, 6),
(186, 6),
(192, 6),
(198, 6),
(208, 6),
(212, 6),
(216, 6),
(222, 6),
(259, 6),
(260, 6),
(262, 6),
(263, 6),
(267, 6),
(303, 6),
(304, 6),
(305, 6),
(306, 6),
(307, 6),
(308, 6),
(309, 6),
(316, 6),
(317, 6),
(318, 6),
(319, 6),
(320, 6),
(321, 6),
(322, 6),
(323, 6),
(324, 6),
(325, 6),
(326, 6),
(327, 6),
(328, 6),
(329, 6),
(330, 6),
(331, 6),
(332, 6),
(333, 6),
(334, 6),
(335, 6),
(341, 6),
(353, 7),
(354, 7),
(355, 7);

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
(6, 'App\\Models\\User', 57),
(7, 'App\\Models\\User', 58),
(7, 'App\\Models\\User', 59),
(7, 'App\\Models\\User', 60),
(6, 'App\\Models\\User', 61),
(6, 'App\\Models\\User', 62),
(6, 'App\\Models\\User', 63),
(6, 'App\\Models\\User', 64),
(4, 'App\\Models\\User', 65),
(4, 'App\\Models\\User', 66);

INSERT INTO `menu_items` (`id`, `label`, `route`, `params`, `slug`, `permission`, `parent`, `module`, `section`, `sort`, `class`, `icon`, `badge`, `badgeable`, `badge_callback`, `menu`, `depth`, `quick_link`, `status`, `role_id`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'static.dashboard', 'admin.dashboard.index', NULL, 'staticdashboard', '', 0, NULL, 'static.home', 0, NULL, 'ri-dashboard-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(2, 'static.users.users', 'admin.user.index', NULL, 'staticusersusers', 'user.index', 0, NULL, 'static.user_management', 1, NULL, 'ri-group-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(3, 'static.users.all', 'admin.user.index', NULL, 'staticusersall', 'user.index', 2, NULL, 'static.user_management', 2, NULL, 'ri-user-3-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(4, 'static.users.add', 'admin.user.create', NULL, 'staticusersadd', 'user.create', 2, NULL, 'static.user_management', 3, NULL, 'ri-user-add-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(5, 'static.users.role_permissions', 'admin.role.index', NULL, 'staticusersrole-permissions', 'role.index', 2, NULL, 'static.user_management', 4, NULL, 'ri-lock-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(6, 'static.media.media', 'admin.media.index', NULL, 'staticmediamedia', 'attachment.index', 0, NULL, 'static.home', 5, NULL, 'ri-folder-open-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(7, 'static.blogs.blogs', 'admin.blog.index', NULL, 'staticblogsblogs', 'blog.index', 0, NULL, 'static.content_management', 6, NULL, 'ri-pushpin-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(8, 'static.blogs.all_blogs', 'admin.blog.index', NULL, 'staticblogsall-blogs', 'blog.index', 7, NULL, 'static.content_management', 7, NULL, 'ri-bookmark-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(9, 'static.blogs.add_blogs', 'admin.blog.create', NULL, 'staticblogsadd-blogs', 'blog.create', 7, NULL, 'static.content_management', 8, NULL, 'ri-add-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(10, 'static.categories.categories', 'admin.category.index', NULL, 'staticcategoriescategories', 'category.index', 7, NULL, 'static.content_management', 9, NULL, 'ri-folder-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(11, 'static.tags.tags', 'admin.tag.index', NULL, 'statictagstags', 'tag.index', 7, NULL, 'static.content_management', 10, NULL, 'ri-price-tag-3-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(12, 'static.pages.pages', 'admin.page.index', NULL, 'staticpagespages', 'page.index', 0, NULL, 'static.content_management', 11, NULL, 'ri-pages-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(13, 'static.pages.all_page', 'admin.page.index', NULL, 'staticpagesall-page', 'page.index', 12, NULL, 'static.content_management', 12, NULL, 'ri-list-check', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(14, 'static.pages.add', 'admin.page.create', NULL, 'staticpagesadd', 'page.create', 12, NULL, 'static.content_management', 13, NULL, 'ri-add-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(15, 'static.notify_templates.notify_templates', 'admin.email-template.index', NULL, 'staticnotify-templatesnotify-templates', 'email_template.index', 0, NULL, 'static.promotion_management', 14, NULL, 'ri-pushpin-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(16, 'static.notify_templates.email', 'admin.email-template.index', NULL, 'staticnotify-templatesemail', 'email_template.index', 15, NULL, 'static.promotion_management', 15, NULL, 'ri-dashboard-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(17, 'static.notify_templates.sms', 'admin.sms-template.index', NULL, 'staticnotify-templatessms', 'sms_template.index', 15, NULL, 'static.promotion_management', 16, NULL, 'ri-dashboard-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(18, 'static.notify_templates.push_notification', 'admin.push-notification-template.index', NULL, 'staticnotify-templatespush-notification', 'push_notification_template.index', 15, NULL, 'static.promotion_management', 17, NULL, 'ri-dashboard-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(19, 'static.testimonials.testimonials', 'admin.testimonial.index', NULL, 'statictestimonialstestimonials', 'testimonial.index', 0, NULL, 'static.promotion_management', 18, NULL, 'ri-group-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(20, 'static.testimonials.all_testimonials', 'admin.testimonial.index', NULL, 'statictestimonialsall-testimonials', 'testimonial.index', 19, NULL, 'static.promotion_management', 19, NULL, 'ri-list-check', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(21, 'static.testimonials.add', 'admin.testimonial.create', NULL, 'statictestimonialsadd', 'testimonial.create', 19, NULL, 'static.promotion_management', 20, NULL, 'ri-add-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(22, 'static.faqs.faqs', 'admin.faq.index', NULL, 'staticfaqsfaqs', 'faq.index', 0, NULL, 'static.content_management', 21, NULL, 'ri-questionnaire-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(23, 'static.general_settings', 'admin.setting.index', NULL, 'staticgeneral-settings', 'setting.index', 0, NULL, 'static.setting_management', 22, NULL, 'ri-settings-5-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(24, 'static.languages.languages', 'admin.language.index', NULL, 'staticlanguageslanguages', 'language.index', 23, NULL, 'static.setting_management', 23, NULL, 'ri-translate-2', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(25, 'static.taxes.taxes', 'admin.tax.index', NULL, 'statictaxestaxes', 'tax.index', 23, NULL, 'static.financial_management', 24, NULL, 'ri-percent-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(26, 'static.currencies.currencies', 'admin.currency.index', NULL, 'staticcurrenciescurrencies', 'currency.index', 23, NULL, 'static.financial_management', 25, NULL, 'ri-currency-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(27, 'static.plugins.plugins', 'admin.plugin.index', NULL, 'staticpluginsplugins', 'plugin.index', 23, NULL, 'static.setting_management', 26, NULL, 'ri-plug-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(28, 'static.payment_methods.payment_methods', 'admin.payment-method.index', NULL, 'staticpayment-methodspayment-methods', 'payment-method.index', 23, NULL, 'static.setting_management', 27, NULL, 'ri-secure-payment-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(29, 'static.sms_gateways.sms_gateways', 'admin.sms-gateway.index', NULL, 'staticsms-gatewayssms-gateways', 'sms-gateway.index', 23, NULL, 'static.setting_management', 28, NULL, 'ri-message-2-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(30, 'static.systems.about', 'admin.about-system.index', NULL, 'staticsystemsabout', 'about-system.index', 23, NULL, 'static.setting_management', 29, NULL, 'ri-apps-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(31, 'static.settings.settings', 'admin.setting.index', NULL, 'staticsettingssettings', 'setting.index', 23, NULL, 'static.setting_management', 30, NULL, 'ri-settings-5-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(32, 'static.appearance.appearance', 'admin.robot.index', NULL, 'staticappearanceappearance', 'appearance.index', 0, NULL, 'static.setting_management', 31, NULL, 'ri-swap-3-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(33, 'static.appearance.robots', 'admin.robot.index', NULL, 'staticappearancerobots', 'appearance.index', 32, NULL, 'static.setting_management', 32, NULL, '', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(34, 'static.landing_pages.landing_page_title', 'admin.landing-page.index', NULL, 'staticlanding-pageslanding-page-title', 'landing_page.index', 32, NULL, 'static.setting_management', 33, NULL, 'ri-pages-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(35, 'static.landing_pages.subscribers', 'admin.subscribes', NULL, 'staticlanding-pagessubscribers', 'landing_page.index', 32, NULL, 'static.setting_management', 34, NULL, 'ri-pages-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(36, 'static.appearance.customizations', 'admin.customization.index', NULL, 'staticappearancecustomizations', 'appearance.index', 32, NULL, 'static.setting_management', 35, NULL, 'ri-pages-line', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(37, 'static.system_tools.system_tools', 'admin.backup.index', NULL, 'staticsystem-toolssystem-tools', 'system-tool.index', 0, NULL, 'static.setting_management', 36, NULL, 'ri-shield-user-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(38, 'static.system_tools.backup', 'admin.backup.index', NULL, 'staticsystem-toolsbackup', 'system-tool.index', 37, NULL, 'static.setting_management', 37, NULL, '', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(39, 'static.system_tools.activity_logs', 'admin.activity-logs.index', NULL, 'staticsystem-toolsactivity-logs', 'system-tool.index', 37, NULL, 'static.setting_management', 38, NULL, '', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(40, 'static.system_tools.database_cleanup', 'admin.cleanup-db.index', NULL, 'staticsystem-toolsdatabase-cleanup', 'system-tool.index', 37, NULL, 'static.setting_management', 39, NULL, '', 0, 0, NULL, 1, 1, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL),
(41, 'static.menus.menus', 'admin.menu.index', NULL, 'staticmenusmenus', 'menu.index', 0, NULL, 'static.setting_management', 40, NULL, 'ri-menu-2-line', 0, 0, NULL, 1, 0, 0, 1, 0, 1, '2025-10-15 12:41:35', '2025-10-15 12:41:35', NULL);

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
(30, '2024_07_18_084756_create_airports_table', 1),
(31, '2024_07_19_082823_create_priorities_table', 1),
(32, '2024_07_19_090319_create_zones_table', 1),
(33, '2024_07_19_090419_create_addresses_table', 1),
(34, '2024_07_19_130334_create_faqs_table', 1),
(35, '2024_07_22_070950_create_driver_rules_table', 1),
(36, '2024_07_22_090803_create_form_fields_table', 1),
(37, '2024_07_22_124552_create_payment_accounts_table', 1),
(38, '2024_07_24_083029_create_message_table', 1),
(39, '2024_07_24_101439_create_wallets_table', 1),
(40, '2024_07_24_103346_create_driver_documents_table', 1),
(41, '2024_07_25_052049_create_ticket_settings_table', 1),
(42, '2024_08_01_061513_create_statuses_table', 1),
(43, '2024_08_02_115838_create_hourly_packages_table', 1),
(44, '2024_08_02_130158_create_coupons_table', 1),
(45, '2024_08_12_045713_create_departments_table', 1),
(46, '2024_08_12_115839_create_service_categories_table', 1),
(47, '2024_08_13_052445_create_tickets_table', 1),
(48, '2024_08_29_102551_create_withdraw_requests_table', 1),
(49, '2024_08_31_033317_add_alternative_text_to_media_table', 1),
(50, '2024_08_31_052446_create_reports_table', 1),
(51, '2024_09_03_070923_create_push_notifications_table', 1),
(52, '2024_09_03_072944_create_ratings_table', 1),
(53, '2024_09_06_122033_create_knowledge_base_categories_table', 1),
(54, '2024_09_06_123438_create_landing_pages_table', 1),
(55, '2024_09_07_094637_create_knowledge_base_tags_table', 1),
(56, '2024_09_09_094216_create_knowledge_bases_table', 1),
(57, '2024_09_09_115527_create_cancellation_reasons_table', 1),
(58, '2024_10_01_124515_create_rental_vehicles', 1),
(59, '2024_10_02_115839_create_preferences_table', 1),
(60, '2024_10_02_115840_create_rides_table', 1),
(61, '2024_10_07_120923_create_rider_reviews_table', 1),
(62, '2024_10_07_121023_create_driver_reviews_table', 1),
(63, '2024_10_08_070424_create_sos_table', 1),
(64, '2024_10_12_083722_create_email_templates', 1),
(65, '2024_10_14_111617_create_sms_templates', 1),
(66, '2024_10_15_041531_create_push_notification_templates', 1),
(67, '2024_11_22_062049_create_notices_table', 1),
(68, '2024_11_25_035910_create_testimonials_table', 1),
(69, '2024_11_27_054315_create_backup_logs', 1),
(70, '2024_11_28_120846_create_activity_log_table', 1),
(71, '2024_11_28_120847_add_event_column_to_activity_log_table', 1),
(72, '2024_11_28_120848_add_batch_uuid_column_to_activity_log_table', 1),
(73, '2024_12_16_035102_create_customizations_table', 1),
(74, '2024_12_22_060359_create_cab_commission_histories_table', 1),
(75, '2025_01_03_092822_create_plans_table', 1),
(76, '2025_01_20_133742_2023_10_07_060301_create_subscribes_table', 1),
(77, '2025_03_12_052604_create_onboardings_table', 1),
(78, '2025_06_20_084145_create_surge_prices_table', 1),
(79, '2025_07_01_115854_create_extra_charges_table', 1),
(80, '2025_09_12_133718_add_google_id_column_to_users_table', 1),
(81, '2025_09_12_134049_add_google_id_column', 1);


SET FOREIGN_KEY_CHECKS=0;

-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2025 at 08:29 AM
-- Server version: 8.0.43-0ubuntu0.22.04.1
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxido_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `fleet_documents`
--

-- 25th sept

ALTER TABLE `documents` CHANGE `type` `type` ENUM('vehicle','driver','fleet_manager') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'driver';

ALTER TABLE `vehicle_info` ADD `model_year` VARCHAR(255) NULL AFTER `model`;


CREATE TABLE `vehicle_info_docs` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_info_id` bigint UNSIGNED DEFAULT NULL,
  `document_id` bigint UNSIGNED DEFAULT NULL,
  `document_image_id` bigint UNSIGNED DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
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
-- Indexes for table `vehicle_info_docs`
--
ALTER TABLE `vehicle_info_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_info_docs_vehicle_info_id_foreign` (`vehicle_info_id`),
  ADD KEY `vehicle_info_docs_document_id_foreign` (`document_id`),
  ADD KEY `vehicle_info_docs_document_image_id_foreign` (`document_image_id`),
  ADD KEY `vehicle_info_docs_created_by_id_foreign` (`created_by_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vehicle_info_docs`
--
ALTER TABLE `vehicle_info_docs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicle_info_docs`
--
ALTER TABLE `vehicle_info_docs`
  ADD CONSTRAINT `vehicle_info_docs_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_info_docs_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_info_docs_document_image_id_foreign` FOREIGN KEY (`document_image_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_info_docs_vehicle_info_id_foreign` FOREIGN KEY (`vehicle_info_id`) REFERENCES `vehicle_info` (`id`) ON DELETE CASCADE;


ALTER TABLE `vehicle_info_docs` ADD `fleet_manager_id` BIGINT NULL AFTER `vehicle_info_id`;

-- 26th Sept
ALTER TABLE `vehicle_info` ADD `is_verified` INT NULL DEFAULT NULL AFTER `fleet_manager_id`;


-- 30th Sept
ALTER TABLE `zones` ADD `total_rides_in_peak_zone` BIGINT NULL AFTER `currency_id`, ADD `peak_zone_geographic_radius` BIGINT NULL AFTER `total_rides_in_peak_zone`, ADD `minutes_choosing_peak_zone` BIGINT NULL AFTER `peak_zone_geographic_radius`, ADD `minutes_peak_zone_active` BIGINT NULL AFTER `minutes_choosing_peak_zone`, ADD `peak_price_increase_percentage` BIGINT NULL AFTER `minutes_peak_zone_active`;

ALTER TABLE `zones` CHANGE `peak_zone_geographic_radius` `peak_zone_geographic_radius` DOUBLE NULL DEFAULT NULL;

ALTER TABLE `zones` CHANGE `peak_price_increase_percentage` `peak_price_increase_percentage` DOUBLE NULL DEFAULT NULL;



CREATE TABLE `peak_zones` (
  `id` bigint UNSIGNED NOT NULL,
  `zone_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Auto-generated Peak Zone',
  `polygon` geometry DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '0',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peak_zones`
--
ALTER TABLE `peak_zones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peak_zones_created_by_id_foreign` (`created_by_id`),
  ADD KEY `peak_zones_zone_id_foreign` (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peak_zones`
--
ALTER TABLE `peak_zones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peak_zones`
--
ALTER TABLE `peak_zones`
  ADD CONSTRAINT `peak_zones_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peak_zones_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE CASCADE;


ALTER TABLE `peak_zones` ADD `locations` JSON NULL AFTER `polygon`;

-- 6th Oct preferences and vehicle type zone preferences
ALTER TABLE `vehicle_type_zones` ADD `is_allow_preference` BIGINT NULL AFTER `is_allow_tax`;


CREATE TABLE `preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `icon_image_id` bigint UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preferences_icon_image_id_foreign` (`icon_image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_icon_image_id_foreign` FOREIGN KEY (`icon_image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL;


CREATE TABLE `vehicle_type_zone_preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_type_zone_id` bigint UNSIGNED NOT NULL,
  `preference_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vehicle_type_zone_preferences`
--
ALTER TABLE `vehicle_type_zone_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_type_zone_preferences_vehicle_type_zone_id_foreign` (`vehicle_type_zone_id`),
  ADD KEY `vehicle_type_zone_preferences_preference_id_foreign` (`preference_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vehicle_type_zone_preferences`
--
ALTER TABLE `vehicle_type_zone_preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicle_type_zone_preferences`
--
ALTER TABLE `vehicle_type_zone_preferences`
  ADD CONSTRAINT `vehicle_type_zone_preferences_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_type_zone_preferences_vehicle_type_zone_id_foreign` FOREIGN KEY (`vehicle_type_zone_id`) REFERENCES `vehicle_type_zones` (`id`) ON DELETE CASCADE;


ALTER TABLE `preferences` ADD `name` LONGTEXT NULL AFTER `id`;

-- 7th Oct

--
-- Table structure for table `driver_preferences`
--

CREATE TABLE `driver_preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED DEFAULT NULL,
  `preference_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver_preferences`
--
ALTER TABLE `driver_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_preferences_driver_id_foreign` (`driver_id`),
  ADD KEY `driver_preferences_preference_id_foreign` (`preference_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver_preferences`
--
ALTER TABLE `driver_preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver_preferences`
--
ALTER TABLE `driver_preferences`
  ADD CONSTRAINT `driver_preferences_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `driver_preferences_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE;



CREATE TABLE `ride_preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `ride_id` bigint UNSIGNED DEFAULT NULL,
  `preference_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ride_preferences`
--
ALTER TABLE `ride_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_preferences_preference_id_foreign` (`preference_id`),
  ADD KEY `ride_preferences_ride_id_foreign` (`ride_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ride_preferences`
--
ALTER TABLE `ride_preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ride_preferences`
--
ALTER TABLE `ride_preferences`
  ADD CONSTRAINT `ride_preferences_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ride_preferences_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`id`) ON DELETE CASCADE;



CREATE TABLE `ride_request_preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `ride_request_id` bigint UNSIGNED DEFAULT NULL,
  `preference_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ride_request_preferences`
--
ALTER TABLE `ride_request_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_request_preferences_preference_id_foreign` (`preference_id`),
  ADD KEY `ride_request_preferences_ride_request_id_foreign` (`ride_request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ride_request_preferences`
--
ALTER TABLE `ride_request_preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ride_request_preferences`
--
ALTER TABLE `ride_request_preferences`
  ADD CONSTRAINT `ride_request_preferences_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ride_request_preferences_ride_request_id_foreign` FOREIGN KEY (`ride_request_id`) REFERENCES `ride_requests` (`id`) ON DELETE CASCADE;


ALTER TABLE `ride_requests` ADD `preference_charge` DOUBLE NULL AFTER `additional_weight_charge`;

ALTER TABLE `rides` ADD `preference_charge` DOUBLE NULL AFTER `additional_weight_charge`;


CREATE TABLE `cab_referral_bonuses` (
  `id` bigint UNSIGNED NOT NULL,
  `referrer_id` bigint UNSIGNED NOT NULL,
  `referred_id` bigint UNSIGNED NOT NULL,
  `referrer_type` enum('rider','driver') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'rider',
  `referred_type` enum('rider','driver') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ride_amount` double DEFAULT NULL,
  `referrer_percentage` double DEFAULT NULL,
  `referred_percentage` double DEFAULT NULL,
  `referred_bonus_amount` double DEFAULT NULL,
  `referrer_bonus_amount` double DEFAULT NULL,
  `bonus_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `credited_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cab_referral_bonuses`
--
ALTER TABLE `cab_referral_bonuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cab_referral_bonuses_referrer_id_index` (`referrer_id`),
  ADD KEY `cab_referral_bonuses_referred_id_index` (`referred_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cab_referral_bonuses`
--
ALTER TABLE `cab_referral_bonuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cab_referral_bonuses`
--
ALTER TABLE `cab_referral_bonuses`
  ADD CONSTRAINT `cab_referral_bonuses_referred_id_foreign` FOREIGN KEY (`referred_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cab_referral_bonuses_referrer_id_foreign` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;


-- 13th Oct

ALTER TABLE `rides` ADD `total_extra_charge` DOUBLE NULL DEFAULT '0.0' AFTER `payment_status`;

DROP TABLE `extra_charges`;

CREATE TABLE `extra_charges` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `amount` double DEFAULT NULL,
  `ride_id` bigint UNSIGNED DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `extra_charges`
--
ALTER TABLE `extra_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extra_charges_created_by_id_foreign` (`created_by_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `extra_charges`
--
ALTER TABLE `extra_charges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `extra_charges`
--
ALTER TABLE `extra_charges`
  ADD CONSTRAINT `extra_charges_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;


ALTER TABLE `vehicle_type_zones` ADD `is_allow_incentive` INT NULL DEFAULT '0' AFTER `waiting_charge`, ADD `incentive_period` ENUM('daily','weekly') NULL AFTER `is_allow_incentive`, ADD `incentive_target_rides` INT NULL AFTER `incentive_period`, ADD `incentive_amount` DOUBLE NULL AFTER `incentive_target_rides`;


CREATE TABLE `incentive_levels` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_type_zone_id` bigint UNSIGNED NOT NULL,
  `period_type` enum('daily','weekly') COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_number` tinyint UNSIGNED NOT NULL,
  `target_rides` int UNSIGNED NOT NULL,
  `incentive_amount` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incentive_levels`
--
ALTER TABLE `incentive_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_level_per_period` (`vehicle_type_zone_id`,`period_type`,`level_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incentive_levels`
--
ALTER TABLE `incentive_levels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incentive_levels`
--
ALTER TABLE `incentive_levels`
  ADD CONSTRAINT `incentive_levels_vehicle_type_zone_id_foreign` FOREIGN KEY (`vehicle_type_zone_id`) REFERENCES `vehicle_type_zones` (`id`) ON DELETE CASCADE;


CREATE TABLE `incentives` (
  `id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `incentive_level_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicable_date` date NOT NULL,
  `target_rides` int NOT NULL,
  `bonus_amount` decimal(10,2) NOT NULL,
  `is_achieved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incentives`
--
ALTER TABLE `incentives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incentives_driver_id_foreign` (`driver_id`),
  ADD KEY `incentives_incentive_level_id_foreign` (`incentive_level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incentives`
--
ALTER TABLE `incentives`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incentives`
--
ALTER TABLE `incentives`
  ADD CONSTRAINT `incentives_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incentives_incentive_level_id_foreign` FOREIGN KEY (`incentive_level_id`) REFERENCES `incentive_levels` (`id`) ON DELETE SET NULL;



CREATE TABLE `driver_incentive_progress` (
  `id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `vehicle_type_zone_id` bigint UNSIGNED NOT NULL,
  `period_type` enum('daily','weekly') COLLATE utf8mb4_unicode_ci NOT NULL,
  `period_date` date NOT NULL,
  `current_rides` int UNSIGNED NOT NULL DEFAULT '0',
  `last_completed_level` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `completed_levels` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tablesHow to cancel an ongoing AJAX request?
--

--
-- Indexes for table `driver_incentive_progress`
--
ALTER TABLE `driver_incentive_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_driver_period_progress` (`driver_id`,`vehicle_type_zone_id`,`period_type`,`period_date`),
  ADD KEY `driver_incentive_progress_vehicle_type_zone_id_foreign` (`vehicle_type_zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver_incentive_progress`
--
ALTER TABLE `driver_incentive_progress`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver_incentive_progress`
--
ALTER TABLE `driver_incentive_progress`
  ADD CONSTRAINT `driver_incentive_progress_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `driver_incentive_progress_vehicle_type_zone_id_foreign` FOREIGN KEY (`vehicle_type_zone_id`) REFERENCES `vehicle_type_zones` (`id`) ON DELETE CASCADE;


ALTER TABLE `rides` ADD `uuid` LONGTEXT NULL AFTER `id`;

ALTER TABLE `cab_referral_bonuses` ADD `currency_symbol` LONGTEXT NULL AFTER `referred_type`;

ALTER TABLE `vehicle_info` CHANGE `is_verified` `is_verified` INT NULL DEFAULT '0';

ALTER TABLE `rides` ADD `start_ride_locations` JSON NULL AFTER `location_coordinates`, ADD `start_ride_coordinates` JSON NULL AFTER `start_ride_locations`;

ALTER TABLE `rides` ADD `peak_zone_charge` DOUBLE NULL AFTER `ride_fare`;

ALTER TABLE `ride_requests` ADD `peak_zone_charge` DOUBLE NULL AFTER `ride_fare`;


ALTER TABLE `extra_charges` ADD `status` INT NULL DEFAULT '1' AFTER `ride_id`;

ALTER TABLE `vehicle_types` ADD `description` LONGTEXT NULL AFTER `name`;

-- Done on Live

COMMIT;
