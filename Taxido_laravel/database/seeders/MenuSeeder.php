<?php

namespace Database\Seeders;

use App\Models\Menus;
use App\Models\MenuItems;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $menu = Menus::updateOrCreate(['name' => 'Admin'], [
            'name' => 'Admin',
            'status' => true,
            'system_reserve' => true
        ]);
        $menuItems = [
            [
                'label' => 'sidebar.dashboard',
                'icon' => 'ri-dashboard-line',
                'route' => 'admin.dashboard.index',
                'permission' => '',
                'section' => 'sidebar.home',
                'depth' => 0,
                'child' => []
            ],
            [
                'label' => 'sidebar.users',
                'icon' => 'ri-group-line',
                'route' => 'admin.user.index',
                'permission' => 'user.index',
                'section' => 'sidebar.user_management',
                'depth' => 0,
                'child' => [
                    [
                        'label' => 'sidebar.all_users',
                        'icon' => 'ri-user-3-line',
                        'route' => 'admin.user.index',
                        'permission' => 'user.index',
                        'section' => 'sidebar.user_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.add_user',
                        'icon' => 'ri-user-add-line',
                        'route' => 'admin.user.create',
                        'permission' => 'user.create',
                        'section' => 'sidebar.user_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.role_permissions',
                        'icon' => 'ri-lock-line',
                        'route' => 'admin.role.index',
                        'permission' => 'role.index',
                        'section' => 'sidebar.user_management',
                        'depth' => 1,
                        'child' => []
                    ]
                ]
            ],
            [
                'label' => 'sidebar.media',
                'icon' => 'ri-folder-open-line',
                'section' => 'sidebar.home',
                'route' => 'admin.media.index',
                'permission' => 'attachment.index',
                'depth' => 0,
                'child' => []
            ],
            [
                'label' => 'sidebar.blogs',
                'icon' => 'ri-pushpin-line',
                'route' => 'admin.blog.index',
                'permission' => 'blog.index',
                'section' => 'sidebar.content_management',
                'depth' => 0,
                'child' => [
                    [
                        'label' => 'sidebar.all_blogs',
                        'icon' => 'ri-bookmark-line',
                        'route' => 'admin.blog.index',
                        'permission' => 'blog.index',
                        'section' => 'sidebar.content_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.add_blogs',
                        'icon' => 'ri-add-line',
                        'section' => 'sidebar.content_management',
                        'route' => 'admin.blog.create',
                        'permission' => 'blog.create',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.categories',
                        'icon' => 'ri-folder-line',
                        'route' => 'admin.category.index',
                        'permission' => 'category.index',
                        'section' => 'sidebar.content_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.tags',
                        'icon' => 'ri-price-tag-3-line',
                        'route' => 'admin.tag.index',
                        'section' => 'sidebar.content_management',
                        'permission' => 'tag.index',
                        'depth' => 1,
                        'child' => []
                    ],
                ]
            ],
            [
                'label' => 'sidebar.pages',
                'icon' => 'ri-pages-line',
                'route' => 'admin.page.index',
                'permission' => 'page.index',
                'section' => 'sidebar.content_management',
                'depth' => 0,
                'child' => [
                    [
                        'label' => 'sidebar.all_pages',
                        'icon' => 'ri-list-check',
                        'route' => 'admin.page.index',
                        'permission' => 'page.index',
                        'section' => 'sidebar.content_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.add_page',
                        'icon' => 'ri-add-line',
                        'route' => 'admin.page.create',
                        'permission' => 'page.create',
                        'section' => 'sidebar.content_management',
                        'depth' => 1,
                        'child' => []
                    ],
                ]
            ],
            [
                'label' => 'sidebar.notify_templates',
                'icon' => 'ri-pushpin-line',
                'route' => 'admin.email-template.index',
                'permission' => 'email_template.index',
                'section' => 'sidebar.promotion_management',
                'depth' => 0,
                'child' => [
                    [
                        'label' => 'sidebar.email_templates',
                        'icon' => 'ri-dashboard-line',
                        'route' => 'admin.email-template.index',
                        'permission' => 'email_template.index',
                        'section' => 'sidebar.promotion_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.sms_templates',
                        'icon' => 'ri-dashboard-line',
                        'route' => 'admin.sms-template.index',
                        'permission' => 'sms_template.index',
                        'section' => 'sidebar.promotion_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.push_notification_templates',
                        'icon' => 'ri-dashboard-line',
                        'route' => 'admin.push-notification-template.index',
                        'permission' => 'push_notification_template.index',
                        'section' => 'sidebar.promotion_management',
                        'depth' => 1,
                        'child' => []
                    ],
                ]
            ],
            [
                'label' => 'sidebar.testimonials',
                'icon' => 'ri-group-line',
                'route' => 'admin.testimonial.index',
                'permission' => 'testimonial.index',
                'section' => 'sidebar.promotion_management',
                'depth' => 0,
                'child' => [
                    [
                        'label' => 'sidebar.all_testimonials',
                        'icon' => 'ri-list-check',
                        'route' => 'admin.testimonial.index',
                        'permission' => 'testimonial.index',
                        'section' => 'sidebar.promotion_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.add_testimonial',
                        'icon' => 'ri-add-line',
                        'route' => 'admin.testimonial.create',
                        'permission' => 'testimonial.create',
                        'section' => 'sidebar.promotion_management',
                        'depth' => 1,
                        'child' => []
                    ],
                ]
            ],
            [
                'label' => 'sidebar.faqs',
                'icon'  => 'ri-questionnaire-line',
                'route' => 'admin.faq.index',
                'permission' => 'faq.index',
                'section' => 'sidebar.content_management',
                'depth' => 0,
                'child' => []
            ],
            [
                'label' => 'sidebar.general_settings',
                'icon' => 'ri-settings-5-line',
                'route' => 'admin.setting.index',
                'permission' => 'setting.index',
                'section' => 'sidebar.setting_management',
                'depth' => 0,
                'child' => [
                    [
                        'label' => 'sidebar.languages',
                        'icon'  => 'ri-translate-2',
                        'section' => 'sidebar.setting_management',
                        'route' => 'admin.language.index',
                        'permission' => 'language.index',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.taxes',
                        'icon'  => 'ri-percent-line',
                        'route' => 'admin.tax.index',
                        'permission' => 'tax.index',
                        'section' => 'sidebar.financial_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.currencies',
                        'icon'  => 'ri-currency-line',
                        'route' => 'admin.currency.index',
                        'permission' => 'currency.index',
                        'section' => 'sidebar.financial_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.plugins',
                        'icon'  => 'ri-plug-line',
                        'route' => 'admin.plugin.index',
                        'permission' => 'plugin.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.payment_methods',
                        'icon'  => 'ri-secure-payment-line',
                        'route' => 'admin.payment-method.index',
                        'permission' => 'payment-method.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.sms_gateways',
                        'icon'  => 'ri-message-2-line',
                        'route' => 'admin.sms-gateway.index',
                        'permission' => 'sms-gateway.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.about_system',
                        'icon'  => 'ri-apps-line',
                        'route' => 'admin.about-system.index',
                        'permission' => 'about-system.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.settings',
                        'icon'  => 'ri-settings-5-line',
                        'route' => 'admin.setting.index',
                        'permission' => 'setting.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                ]
            ],
            [
                'label' => 'sidebar.appearance',
                'icon' => 'ri-swap-3-line',
                'route' => 'admin.robot.index',
                'permission' => 'appearance.index',
                'section' => 'sidebar.setting_management',
                'depth' => 0,
                'child' => [
                    [
                        'label' => 'sidebar.robots',
                        'icon'  => '',
                        'route' => 'admin.robot.index',
                        'permission' => 'appearance.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.landing_page',
                        'icon'  => 'ri-pages-line',
                        'route' => 'admin.landing-page.index',
                        'permission' => 'landing_page.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.subscribers',
                        'icon'  => 'ri-pages-line',
                        'route' => 'admin.subscribes',
                        'permission' => 'landing_page.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.customizations',
                        'icon'  => 'ri-pages-line',
                        'route' => 'admin.customization.index',
                        'permission' => 'appearance.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ]
                ]
            ],
            [
                'label' => 'sidebar.system_tools',
                'icon' => 'ri-shield-user-line',
                'route' => 'admin.backup.index',
                'permission' => 'system-tool.index',
                'section' => 'sidebar.setting_management',
                'depth' => 0,
                'child' => [
                    [
                        'label' => 'sidebar.backup',
                        'icon'  => '',
                        'route' => 'admin.backup.index',
                        'permission' => 'system-tool.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.activity_logs',
                        'icon'  => '',
                        'route' => 'admin.activity-logs.index',
                        'permission' => 'system-tool.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                    [
                        'label' => 'sidebar.database_cleanup',
                        'icon'  => '',
                        'route' => 'admin.cleanup-db.index',
                        'permission' => 'system-tool.index',
                        'section' => 'sidebar.setting_management',
                        'depth' => 1,
                        'child' => []
                    ],
                ]
            ],
            [
                'label' => 'sidebar.menus',
                'icon' => 'ri-menu-2-line',
                'route' => 'admin.menu.index',
                'permission' => 'menu.index',
                'section' => 'sidebar.setting_management',
                'depth' => 0,
                'child' => []
            ],

        ];

        $sort = 0;
        foreach ($menuItems as $menuItem) {
            $sort = $this->createOrUpdateMenuItem($menuItem, $sort, $menu->id);
            ++$sort;
        }
    }

    private function createOrUpdateMenuItem($menuItem, $sort, $menu, $parent = null)
    {
        $menuItemModel = MenuItems::updateOrCreate([
            'label' => $menuItem['label'],
            'icon' => $menuItem['icon'],
            'route' => $menuItem['route'],
            'permission' => $menuItem['permission'] ?? null,
            'parent' => $parent ? $parent->id : 0,
            'section' => $menuItem['section'],
            'depth' => $menuItem['depth'],
            'sort' => $sort,
            'menu' => $menu
        ]);

        if (count($menuItem['child'])) {
            foreach ($menuItem['child'] as $childMenuItem) {
                $sortIndex = ++$sort;
                $this->createOrUpdateMenuItem($childMenuItem, $sortIndex, $menu, $menuItemModel);
            }

            $sort = $sortIndex;
        }

        return $sort;
    }
}
