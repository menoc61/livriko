TRUNCATE TABLE `menu_items`;

INSERT INTO `menu_items` (`id`, `label`, `route`, `params`, `slug`, `permission`, `parent`, `module`, `section`, `sort`, `class`, `icon`, `badge`, `badgeable`, `menu`, `depth`, `quick_link`, `status`, `role_id`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'static.dashboard', 'admin.dashboard.index', NULL, 'staticdashboard', '', 0, NULL, 'static.home', 0, NULL, 'ri-dashboard-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(2, 'static.users.users', 'admin.user.index', NULL, 'staticusersusers', 'user.index', 0, NULL, 'static.user_management', 1, NULL, 'ri-group-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(3, 'static.users.all', 'admin.user.index', NULL, 'staticusersall', 'user.index', 2, NULL, 'static.user_management', 2, NULL, 'ri-user-3-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(4, 'static.users.add', 'admin.user.create', NULL, 'staticusersadd', 'user.create', 2, NULL, 'static.user_management', 3, NULL, 'ri-user-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(5, 'static.users.role_permissions', 'admin.role.index', NULL, 'staticusersrole-permissions', 'role.index', 2, NULL, 'static.user_management', 4, NULL, 'ri-lock-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(6, 'static.media.media', 'admin.media.index', NULL, 'staticmediamedia', 'attachment.index', 0, NULL, 'static.home', 5, NULL, 'ri-folder-open-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(7, 'static.blogs.blogs', 'admin.blog.index', NULL, 'staticblogsblogs', 'blog.index', 0, NULL, 'static.content_management', 6, NULL, 'ri-pushpin-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(8, 'static.blogs.all_blogs', 'admin.blog.index', NULL, 'staticblogsall-blogs', 'blog.index', 7, NULL, 'static.content_management', 7, NULL, 'ri-bookmark-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(9, 'static.blogs.add_blogs', 'admin.blog.create', NULL, 'staticblogsadd-blogs', 'blog.create', 7, NULL, 'static.content_management', 8, NULL, 'ri-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(10, 'static.categories.categories', 'admin.category.index', NULL, 'staticcategoriescategories', 'category.index', 7, NULL, 'static.content_management', 9, NULL, 'ri-folder-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(11, 'static.tags.tags', 'admin.tag.index', NULL, 'statictagstags', 'tag.index', 7, NULL, 'static.content_management', 10, NULL, 'ri-price-tag-3-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(12, 'static.pages.pages', 'admin.page.index', NULL, 'staticpagespages', 'page.index', 0, NULL, 'static.content_management', 11, NULL, 'ri-pages-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(13, 'static.pages.all_page', 'admin.page.index', NULL, 'staticpagesall-page', 'page.index', 12, NULL, 'static.content_management', 12, NULL, 'ri-list-check', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(14, 'static.pages.add', 'admin.page.create', NULL, 'staticpagesadd', 'page.create', 12, NULL, 'static.content_management', 13, NULL, 'ri-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(15, 'static.notify_templates.notify_templates', 'admin.email-template.index', NULL, 'staticnotify-templatesnotify-templates', 'email_template.index', 0, NULL, 'static.promotion_management', 14, NULL, 'ri-pushpin-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(16, 'static.notify_templates.email', 'admin.email-template.index', NULL, 'staticnotify-templatesemail', 'email_template.index', 15, NULL, 'static.promotion_management', 15, NULL, 'ri-dashboard-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(17, 'static.notify_templates.sms', 'admin.sms-template.index', NULL, 'staticnotify-templatessms', 'sms_template.index', 15, NULL, 'static.promotion_management', 16, NULL, 'ri-dashboard-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(18, 'static.notify_templates.push_notification', 'admin.push-notification-template.index', NULL, 'staticnotify-templatespush-notification', 'push_notification_template.index', 15, NULL, 'static.promotion_management', 17, NULL, 'ri-dashboard-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(19, 'static.testimonials.testimonials', 'admin.testimonial.index', NULL, 'statictestimonialstestimonials', 'testimonial.index', 0, NULL, 'static.promotion_management', 18, NULL, 'ri-group-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(20, 'static.testimonials.all_testimonials', 'admin.testimonial.index', NULL, 'statictestimonialsall-testimonials', 'testimonial.index', 19, NULL, 'static.promotion_management', 19, NULL, 'ri-list-check', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(21, 'static.testimonials.add', 'admin.testimonial.create', NULL, 'statictestimonialsadd', 'testimonial.create', 19, NULL, 'static.promotion_management', 20, NULL, 'ri-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(22, 'static.faqs.faqs', 'admin.faq.index', NULL, 'staticfaqsfaqs', 'faq.index', 0, NULL, 'static.content_management', 21, NULL, 'ri-questionnaire-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(23, 'static.general_settings', 'admin.setting.index', NULL, 'staticgeneral-settings', 'setting.index', 0, NULL, 'static.setting_management', 22, NULL, 'ri-settings-5-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(24, 'static.languages.languages', 'admin.language.index', NULL, 'staticlanguageslanguages', 'language.index', 23, NULL, 'static.setting_management', 23, NULL, 'ri-translate-2', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(25, 'static.taxes.taxes', 'admin.tax.index', NULL, 'statictaxestaxes', 'tax.index', 23, NULL, 'static.financial_management', 24, NULL, 'ri-percent-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(26, 'static.currencies.currencies', 'admin.currency.index', NULL, 'staticcurrenciescurrencies', 'currency.index', 23, NULL, 'static.financial_management', 25, NULL, 'ri-currency-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(27, 'static.plugins.plugins', 'admin.plugin.index', NULL, 'staticpluginsplugins', 'plugin.index', 23, NULL, 'static.setting_management', 26, NULL, 'ri-plug-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(28, 'static.payment_methods.payment_methods', 'admin.payment-method.index', NULL, 'staticpayment-methodspayment-methods', 'payment-method.index', 23, NULL, 'static.setting_management', 27, NULL, 'ri-secure-payment-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(29, 'static.sms_gateways.sms_gateways', 'admin.sms-gateway.index', NULL, 'staticsms-gatewayssms-gateways', 'sms-gateway.index', 23, NULL, 'static.setting_management', 28, NULL, 'ri-message-2-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(30, 'static.systems.about', 'admin.about-system.index', NULL, 'staticsystemsabout', 'about-system.index', 23, NULL, 'static.setting_management', 29, NULL, 'ri-apps-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(31, 'static.settings.settings', 'admin.setting.index', NULL, 'staticsettingssettings', 'setting.index', 23, NULL, 'static.setting_management', 30, NULL, 'ri-settings-5-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(32, 'static.appearance.appearance', 'admin.robot.index', NULL, 'staticappearanceappearance', 'appearance.index', 0, NULL, 'static.setting_management', 31, NULL, 'ri-swap-3-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(33, 'static.appearance.robots', 'admin.robot.index', NULL, 'staticappearancerobots', 'appearance.index', 32, NULL, 'static.setting_management', 32, NULL, '', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(34, 'static.landing_pages.landing_page_title', 'admin.landing-page.index', NULL, 'staticlanding-pageslanding-page-title', 'landing_page.index', 32, NULL, 'static.setting_management', 33, NULL, 'ri-pages-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(35, 'static.landing_pages.subscribers', 'admin.subscribes', NULL, 'staticlanding-pagessubscribers', 'landing_page.index', 32, NULL, 'static.setting_management', 34, NULL, 'ri-pages-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(36, 'static.appearance.customizations', 'admin.customization.index', NULL, 'staticappearancecustomizations', 'appearance.index', 32, NULL, 'static.setting_management', 35, NULL, 'ri-pages-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(37, 'static.system_tools.system_tools', 'admin.backup.index', NULL, 'staticsystem-toolssystem-tools', 'system-tool.index', 0, NULL, 'static.setting_management', 36, NULL, 'ri-shield-user-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(38, 'static.system_tools.backup', 'admin.backup.index', NULL, 'staticsystem-toolsbackup', 'system-tool.index', 37, NULL, 'static.setting_management', 37, NULL, '', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(39, 'static.system_tools.activity_logs', 'admin.activity-logs.index', NULL, 'staticsystem-toolsactivity-logs', 'system-tool.index', 37, NULL, 'static.setting_management', 38, NULL, '', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(40, 'static.system_tools.database_cleanup', 'admin.cleanup-db.index', NULL, 'staticsystem-toolsdatabase-cleanup', 'system-tool.index', 37, NULL, 'static.setting_management', 39, NULL, '', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),
(41, 'static.menus.menus', 'admin.menu.index', NULL, 'staticmenusmenus', 'menu.index', 0, NULL, 'static.setting_management', 40, NULL, 'ri-menu-2-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:21', '2025-02-20 04:57:21', NULL),


(46, 'taxido::static.riders.add', 'admin.rider.create', NULL, 'tx_rider_create', 'rider.create', 42, 17, 'static.user_management', 42, NULL, 'ri-user-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(48, 'taxido::static.wallets.wallet', 'admin.rider-wallet.index', NULL, 'tx_rider_wallet', 'rider_wallet.index', 42, 17, 'static.user_management', 43, NULL, 'ri-wallet-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(50, 'taxido::static.drivers.drivers', NULL, NULL, 'tx_drivers', '', 0, 17, 'static.user_management', 4, NULL, 'ri-user-2-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(52, 'taxido::static.drivers.verified_drivers', 'admin.driver.index', NULL, 'tx_all_drivers', 'driver.index', 50, 17, 'static.user_management', 44, NULL, 'ri-check-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(54, 'ticket::static.ticket.support_ticket', NULL, NULL, 'ticket', 'ticket.ticket.index', 0, 18, 'ticket::static.section', 11, NULL, 'ri-user-voice-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(56, 'ticket::static.ticket.dashboard', 'admin.ticket.dashboard', NULL, 'tc_ticket_dashboard', 'ticket.ticket.index', 54, 18, 'ticket::static.section', 12, NULL, 'ri-group-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(58, 'ticket::static.ticket.all', 'admin.ticket.index', NULL, 'tc_ticket', 'ticket.ticket.index', 54, 18, 'ticket::static.section', 45, NULL, 'ri-group-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(60, 'ticket::static.executive.all_support_executive', 'admin.executive.index', NULL, 'tc_all_executives', 'ticket.executive.index', 54, 18, 'ticket::static.section', 46, NULL, 'ri-team-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(62, 'ticket::static.ticket.status', 'admin.status.index', NULL, 'tc_status', 'ticket.status.index', 54, 18, 'ticket::static.section', 47, NULL, 'ri-group-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(64, 'ticket::static.priority.priority', 'admin.priority.index', NULL, 'tc_priority', 'ticket.priority.index', 54, 18, 'ticket::static.section', 48, NULL, 'ri-group-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(66, 'ticket::static.knowledge.knowledge', NULL, NULL, 'tc_knowledge', 'ticket.knowledge.index', 0, 18, 'ticket::static.section', 13, NULL, 'ri-git-repository-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(68, 'ticket::static.knowledge.all', 'admin.knowledge.index', NULL, 'tc_all_knowledge', 'ticket.knowledge.index', 66, 18, 'ticket::static.section', 49, NULL, 'ri-team-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(70, 'ticket::static.knowledge.add', 'admin.knowledge.create', NULL, 'tc_knowledge_create', 'ticket.knowledge.create', 66, 18, 'ticket::static.section', 50, NULL, 'ri-id-card-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(72, 'ticket::static.knowledge.categories', 'admin.ticket.category.index', NULL, 'tc_category', 'ticket.category.index', 66, 18, 'ticket::static.section', 51, NULL, 'ri-id-card-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(74, 'ticket::static.knowledge.tags', 'admin.ticket.tag.index', NULL, 'tc_tag', 'ticket.tag.index', 66, 18, 'ticket::static.section', 52, NULL, 'ri-id-card-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(76, 'ticket::static.department.department', 'admin.department.index', NULL, 'tc_department', 'ticket.department.index', 54, 18, 'ticket::static.section', 53, NULL, 'ri-group-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(78, 'ticket::static.formfield.formfield', 'admin.formfield.index', NULL, 'tc_formfield', 'ticket.formfield.index', 54, 18, 'ticket::static.section', 54, NULL, 'ri-group-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(80, 'ticket::static.setting.settings', 'admin.ticket.setting.index', NULL, 'tc_setting', 'ticket.setting.index', 54, 18, 'ticket::static.section', 55, NULL, 'ri-group-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:23', '2025-02-20 05:39:27', NULL),
(82, 'taxido::static.drivers.unverified_driver', 'admin.driver.unverified-drivers', NULL, 'tx_unverified_drivers', 'unverified_driver.index', 50, 17, 'static.user_management', 56, NULL, 'ri-alert-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(83, 'taxido::static.drivers.add', 'admin.driver.create', NULL, 'tx_driver_add', 'driver.create', 50, 17, 'static.user_management', 57, NULL, 'ri-add-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(84, 'taxido::static.driver_documents.driver_documents', 'admin.driver-document.index', NULL, 'tx_driverDocument', 'driver_document.index', 50, 17, 'static.user_management', 58, NULL, 'ri-document-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(85, 'taxido::static.driver_rules.driver_rules', 'admin.driver-rule.index', NULL, 'tx_driverRule', 'driver_rule.index', 50, 17, 'static.user_management', 59, NULL, 'ri-gavel-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(86, 'taxido::static.locations.driver_location', 'admin.driver-location.index', NULL, 'tx_locations', 'driver_location.index', 50, 17, 'static.user_management', 60, NULL, 'ri-road-map-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(87, 'taxido::static.notices.notice', 'admin.notice.index', NULL, 'taxido::staticnoticesnotice', 'notice.index', 50, 17, 'static.user_management', 61, NULL, 'ri-notice-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(88, 'taxido::static.wallets.wallet', 'admin.driver-wallet.index', NULL, 'taxido::staticwalletswallet', 'driver_wallet.index', 50, 17, 'static.user_management', 62, NULL, 'ri-wallet-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(89, 'taxido::static.withdraw_requests.withdraw_request', 'admin.withdraw-request.index', NULL, 'tx_withdrawRequest', 'withdraw_request.index', 50, 17, 'static.user_management', 63, NULL, 'ri-money-dollar-circle-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(90, 'taxido::static.commission_histories.commission_histories', 'admin.cab-commission-history.index', NULL, 'tx_commissionHistory', 'cab_commission_history.index', 50, 17, 'static.user_management', 64, NULL, 'ri-money-dollar-circle-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(91, 'taxido::static.zones.zones', NULL, NULL, 'zones', 'zone.index', 0, 17, 'taxido::static.cab_management', 6, NULL, 'ri-route-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(92, 'taxido::static.zones.zones', 'admin.zone.index', NULL, 'tx_zones', 'zone.index', 91, 17, 'taxido::static.cab_management', 65, NULL, 'ri-map-2-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(93, 'taxido::static.zones.add', 'admin.zone.create', NULL, 'tx_zones_create', 'zone.create', 91, 17, 'taxido::static.cab_management', 66, NULL, 'ri-map-2-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(94, 'taxido::static.services.services', 'admin.service.index', NULL, 'tx_service', 'service.index', 0, 17, 'taxido::static.cab_management', 7, NULL, 'ri-taxi-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(95, 'taxido::static.service_categories.serviceCategory', 'admin.service-category.index', NULL, 'tx_serviceCategory', 'service_category.index', 0, 17, 'taxido::static.cab_management', 8, NULL, 'ri-pin-distance-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(96, 'taxido::static.vehicles', NULL, NULL, 'taxido', '', 0, 17, 'taxido::static.cab_management', 9, NULL, 'ri-taxi-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(97, 'taxido::static.vehicle_types.vehicles', 'admin.vehicle-type.index', NULL, 'tx_vehicleType', 'vehicle_type.index', 96, 17, 'taxido::static.cab_management', 67, NULL, 'ri-car-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(98, 'taxido::static.rental_vehicle.rental_vehicles', 'admin.rental-vehicle.index', NULL, 'tx_rental_vehicle', 'rental_vehicle.index', 96, 17, 'taxido::static.cab_management', 68, NULL, 'ri-clock-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(99, 'taxido::static.hourly_package.hourly_packages', 'admin.hourly-package.index', NULL, 'tx_hourlyPackage', 'hourly_package.index', 96, 17, 'taxido::static.cab_management', 69, NULL, 'ri-clock-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(100, 'taxido::static.documents.documents', 'admin.document.index', NULL, 'tx_documents', 'document.index', 96, 17, 'taxido::static.cab_management', 70, NULL, 'ri-file-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(101, 'taxido::static.soses.soses', 'admin.sos.index', NULL, 'tx_sos', 'sos.index', 96, 17, 'taxido::static.cab_management', 71, NULL, 'ri-alert-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(102, 'taxido::static.cancellation-reasons.cancellation-reasons', 'admin.cancellation-reason.index', NULL, 'tx_cancellationReason', 'cancellation_reason.index', 96, 17, 'taxido::static.cab_management', 72, NULL, 'ri-error-warning-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(103, 'taxido::static.subscriptions.subscriptions', NULL, NULL, 'tx_subscription', 'plan.index', 0, 17, 'taxido::static.cab_management', 10, NULL, 'ri-calendar-todo-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(104, 'taxido::static.subscriptions.driver_subscription', 'admin.driver-subscription.index', NULL, 'tx_driverSubscription', 'subscription.index', 103, 17, 'taxido::static.cab_management', 73, NULL, 'ri-file-blank-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(105, 'taxido::static.plans.plans', 'admin.plan.index', NULL, 'tx_plans', 'plan.index', 103, 17, 'taxido::static.cab_management', 74, NULL, 'ri-gavel-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(106, 'taxido::static.coupons.coupons', 'admin.coupon.index', NULL, 'tx_coupons', 'coupon.index', 0, 17, 'taxido::static.cab_management', 11, NULL, 'ri-coupon-2-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(107, 'taxido::static.reports.reports', NULL, NULL, 'tx_reports', 'report.index', 0, 17, 'taxido::static.cab_management', 12, NULL, 'ri-folder-chart-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(108, 'taxido::static.reports.transaction_reports', 'admin.transaction-report.index', NULL, 'tx_transaction_reports', 'report.index', 107, 17, 'taxido::static.cab_management', 75, NULL, 'ri-road-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(109, 'taxido::static.reports.ride_reports', 'admin.ride-report.index', NULL, 'tx_ride_reports', 'report.index', 107, 17, 'taxido::static.cab_management', 76, NULL, 'ri-traffic-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(110, 'taxido::static.reports.driver_reports', 'admin.driver-report.index', NULL, 'tx_driver_reports', 'report.index', 107, 17, 'taxido::static.cab_management', 77, NULL, 'ri-user-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(111, 'taxido::static.reports.coupon_reports', 'admin.coupon-report.index', NULL, 'tx_coupon_reports', 'report.index', 107, 17, 'taxido::static.cab_management', 78, NULL, 'ri-road-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(112, 'taxido::static.reports.zone_reports', 'admin.zone-report.index', NULL, 'tx_zone_reports', 'report.index', 107, 17, 'taxido::static.cab_management', 79, NULL, 'ri-bar-chart-2-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(113, 'taxido::static.reviews.reviews', NULL, NULL, 'tx_reviews', 'driver_review.index', 0, 17, 'taxido::static.cab_management', 13, NULL, 'ri-user-star-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(114, 'taxido::static.reviews.rider_reviews', 'admin.rider-review.index', NULL, 'tx_rider_review', 'rider.create', 113, 17, 'taxido::static.cab_management', 80, NULL, 'ri-star-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(115, 'taxido::static.reviews.driver_reviews', 'admin.driver-review.index', NULL, 'taxido::staticreviewsdriver-reviews', 'driver_review.index', 113, 17, 'taxido::static.cab_management', 81, NULL, 'ri-star-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(116, 'taxido::static.settings.app_settings', 'admin.taxido-setting.index', NULL, 'tx_setting', 'taxido_setting.index', 0, 17, 'taxido::static.cab_management', 14, NULL, 'ri-settings-4-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(117, 'taxido::static.rides.rides', NULL, NULL, 'tx_ride', 'ride.index', 0, 17, 'static.home', 10, NULL, 'ri-map-2-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(118, 'taxido::static.rides.ride_requests', 'admin.ride-request.index', NULL, 'tx_all_ride_requests', 'ride_request.index', 117, 17, 'static.home', 82, NULL, 'ri-traffic-light-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(119, 'taxido::static.rides.all', 'admin.ride.index', NULL, 'tx_all_rides', 'ride.index', 117, 17, 'static.home', 83, NULL, 'ri-traffic-light-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(120, 'taxido::static.rides.requested', 'admin.ride.requested-rides', NULL, 'tx_requested_rides', 'ride.index', 117, 17, 'static.home', 84, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(121, 'taxido::static.rides.scheduled', 'admin.ride.scheduled-rides', NULL, 'tx_scheduled_rides', 'ride.index', 117, 17, 'static.home', 85, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(122, 'taxido::static.rides.accepted', 'admin.ride.accepted-rides', NULL, 'tx_accepted_rides', 'ride.index', 117, 17, 'static.home', 86, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(123, 'taxido::static.rides.arrived', 'admin.ride.arrived-rides', NULL, 'tx_arrived_rides', 'ride.index', 117, 17, 'static.home', 87, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(124, 'taxido::static.rides.started', 'admin.ride.started-rides', NULL, 'tx_started_rides', 'ride.index', 117, 17, 'static.home', 88, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:33', '2025-02-20 05:39:27', NULL),
(125, 'taxido::static.rides.cancelled', 'admin.ride.cancelled-rides', NULL, 'tx_cancelled_rides', 'ride.index', 117, 17, 'static.home', 89, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:34', '2025-02-20 05:39:27', NULL),
(126, 'taxido::static.rides.completed', 'admin.ride.completed-rides', NULL, 'tx_completed_rides', 'ride.index', 117, 17, 'static.home', 90, NULL, 'ri-traffic-light-line', 0, 1, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:34', '2025-02-20 05:39:27', NULL),
(127, 'taxido::static.banners.banners', 'admin.banner.index', NULL, 'tx_banners', 'banner.index', 0, 17, 'static.promotion_management', 91, NULL, 'ri-todo-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:34', '2025-02-20 05:39:27', NULL),
(128, 'taxido::static.push_notification.push_notification', NULL, NULL, 'tx_pushNotification', 'push_notification.index', 0, 17, 'static.promotion_management', 11, NULL, 'ri-send-plane-line', 0, 0, 1, 0, 0, 1, 0, 1, '2025-02-20 04:57:34', '2025-02-20 05:39:27', NULL),
(129, 'taxido::static.push_notification.all', 'admin.push-notification.index', NULL, 'tx_all_pushNotification', 'push_notification.index', 128, 17, 'static.promotion_management', 92, NULL, 'ri-notification-2-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:34', '2025-02-20 05:39:27', NULL),
(130, 'taxido::static.push_notification.send', 'admin.push-notification.create', NULL, 'tx_send_pushNotification', 'push_notification.create', 128, 17, 'static.promotion_management', 93, NULL, 'ri-send-plane-line', 0, 0, 1, 1, 0, 1, 0, 1, '2025-02-20 04:57:34', '2025-02-20 05:39:27', NULL);


--
-- Table structure for table `banner_services`
--

CREATE TABLE `banner_services` (
  `id` bigint UNSIGNED NOT NULL,
  `banner_id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner_services`
--

ALTER TABLE `banner_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banner_services_banner_id_foreign` (`banner_id`),
  ADD KEY `banner_services_service_id_foreign` (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner_services`
--

ALTER TABLE `banner_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banner_services`
--

ALTER TABLE `banner_services`
  ADD CONSTRAINT `banner_services_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `banner_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;


UPDATE `settings` SET `values` = '{\"mail\":null,\"agora\":{\"app_id\":\"\",\"certificate\":\"\"},\"email\":{\"mail_host\":\"ENTER_YOUR_HOST\",\"mail_port\":\"465\",\"mail_mailer\":\"smtp\",\"mail_password\":\"ENTER_YOUR_PASSWORD\",\"mail_username\":\"ENTER_YOUR_USERNAME\",\"mail_from_name\":\"no-reply\",\"mail_encryption\":\"ssl\",\"mail_from_address\":\"ENTER_YOUR_EMAIL@MAIL.COM\"},\"general\":{\"mode\":\"light\",\"copyright\":\"Cab Booking theme by PixelStrap\",\"site_name\":\"Taxido\",\"platform_fees\":\"10\",\"default_timezone\":\"UTC\",\"favicon_image_id\":\"4\",\"dark_logo_image_id\":\"643\",\"default_currency_id\":\"1\",\"default_language_id\":\"1\",\"default_sms_gateway\":\"twilio\",\"light_logo_image_id\":\"641\"},\"firebase\":{\"service_json\":null},\"readings\":{\"status\":\"1\",\"home_page\":null},\"activation\":{\"send_sms\":\"1\",\"demo_mode\":\"1\",\"login_number\":\"1\",\"platform_fees\":\"1\",\"preloader_enabled\":\"1\",\"default_credentials\":\"1\",\"social_login_enable\":\"1\"},\"appearance\":{\"font_family\":\"Inter\",\"primary_color\":\"#199675\",\"sidebar_solid_color\":\"#199675\",\"sidebar_background_type\":\"gradient\",\"sidebar_gradient_color_1\":\"#199675\",\"sidebar_gradient_color_2\":\"#212121\",\"front_font_family\":\"DM Sans\"},\"app_setting\":{\"app_name\":\"Taxido\",\"logo_image_id\":null,\"play_store_link\":null,\"apple_store_link\":null,\"privacy_policy_link\":null,\"term_condition_link\":null},\"maintenance\":{\"content\":null,\"maintenance_mode\":\"0\"},\"social_login\":{\"apple\":{\"client_id\":\"\",\"client_secret\":\"\"},\"google\":{\"client_id\":\"385954585063-alkuv99a6crlch8jd8i4tfefucpd98sv.apps.googleusercontent.com\",\"client_secret\":\"\"},\"facebook\":{\"client_id\":\"\",\"client_secret\":\"\"}},\"google_reCaptcha\":{\"secret\":\"ENTER_YOUR_SECRET_KEY\",\"status\":\"0\",\"site_key\":\"ENTER_YOUR_SITE_KEY\"}}' WHERE `settings`.`id` = 1;

ALTER TABLE plans MODIFY COLUMN duration ENUM('daily', 'weekly', 'monthly', 'yearly') DEFAULT 'monthly';
ALTER TABLE driver_subscriptions MODIFY COLUMN duration ENUM('daily', 'weekly', 'monthly', 'yearly') DEFAULT 'monthly';
