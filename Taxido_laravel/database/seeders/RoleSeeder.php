<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Module;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            'attachments' => [
                'actions' => [
                    'index'   => 'attachment.index',
                    'create'  => 'attachment.create',
                    'edit'    => 'attachment.edit',
                    'trash'  => 'attachment.destroy',
                    'restore' => 'attachment.restore',
                    'delete' => 'attachment.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'destroy', 'edit'],
                ]
            ],
            'users' => [
                'actions' => [
                    'index' => 'user.index',
                    'create'  => 'user.create',
                    'edit'    => 'user.edit',
                    'trash' => 'user.destroy',
                    'restore' => 'user.restore',
                    'delete' => 'user.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy'],
                ]
            ],
            'roles' => [
                'actions' => [
                    'index'   => 'role.index',
                    'create'  => 'role.create',
                    'edit'    => 'role.edit',
                    'delete'  => 'role.destroy'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy'],
                ]
            ],
            'categories' => [
                'actions' => [
                    'index'   => 'category.index',
                    'create'  => 'category.create',
                    'edit'    => 'category.edit',
                    'delete'  => 'category.destroy'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy'],
                    RoleEnum::USER => ['index'],
                ]
            ],
            'tags' => [
                'actions' => [
                    'index'   => 'tag.index',
                    'create'  => 'tag.create',
                    'edit'    => 'tag.edit',
                    'trash'   => 'tag.destroy',
                    'restore' => 'tag.restore',
                    'delete'  => 'tag.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                    RoleEnum::USER => ['index'],
                ]
            ],
            'blogs' => [
                'actions' => [
                    'index'   => 'blog.index',
                    'create'  => 'blog.create',
                    'edit'    => 'blog.edit',
                    'trash'   => 'blog.destroy',
                    'restore' => 'blog.restore',
                    'delete'  => 'blog.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                    RoleEnum::USER => ['index'],
                ]
            ],
            'pages' => [
                'actions' => [
                    'index'   => 'page.index',
                    'create'  => 'page.create',
                    'edit'    => 'page.edit',
                    'trash'   => 'page.destroy',
                    'restore' => 'page.restore',
                    'delete'  => 'page.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                    RoleEnum::USER => ['index'],
                ]
            ],
            'testimonials' => [
                'actions' => [
                    'index'   => 'testimonial.index',
                    'create'  => 'testimonial.create',
                    'edit'    => 'testimonial.edit',
                    'trash'   => 'testimonial.destroy',
                    'restore' => 'testimonial.restore',
                    'delete'  => 'testimonial.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                    RoleEnum::USER => ['index'],
                ]
            ],
            'taxes' => [
                'actions' => [
                    'index'   => 'tax.index',
                    'create'  => 'tax.create',
                    'edit'    => 'tax.edit',
                    'trash'   => 'tax.destroy',
                    'restore' => 'tax.restore',
                    'delete'  => 'tax.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                    RoleEnum::USER => ['index'],
                ]
            ],
            'currencies' => [
                'actions' => [
                    'index'   => 'currency.index',
                    'create'  => 'currency.create',
                    'edit'    => 'currency.edit',
                    'trash'   => 'currency.destroy',
                    'restore' => 'currency.restore',
                    'delete'  => 'currency.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                    RoleEnum::USER => ['index'],
                ]
            ],
            'languages' => [
                'actions' => [
                    'index'   => 'language.index',
                    'create'  => 'language.create',
                    'edit'    => 'language.edit',
                    'trash'   => 'language.destroy',
                    'restore' => 'language.restore',
                    'delete'  => 'language.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                    RoleEnum::USER => ['index'],
                ]
            ],
            'settings' => [
                'actions' => [
                    'index'   =>  'setting.index',
                    'edit'    =>  'setting.edit',
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'edit'],
                ]
            ],
            'system-tools' => [
                'actions' => [
                    'index'   => 'system-tool.index',
                    'create'  => 'system-tool.create',
                    'edit'    => 'system-tool.edit',
                    'trash'   => 'system-tool.destroy',
                    'restore' => 'system-tool.restore',
                    'delete'  => 'system-tool.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                ]
            ],
            'plugins' => [
                'actions' => [
                    'index'   => 'plugin.index',
                    'create'  => 'plugin.create',
                    'edit'    => 'plugin.edit',
                    'trash'   => 'plugin.destroy',
                    'restore' => 'plugin.restore',
                    'delete'  => 'plugin.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                ]
            ],
            'about-system' => [
                'actions' => [
                    'index' => 'about-system.index'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index']
                ]
            ],
            'payment-methods' => [
                'actions' => [
                    'index'   =>  'payment-method.index',
                    'edit'    =>  'payment-method.edit',
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'edit'],
                ]
            ],
            'sms-gateways' => [
                'actions' => [
                    'index' => 'sms-gateway.index',
                    'edit' => 'sms-gateway.edit',
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'edit'],
                ],
            ],
            'sms_templates' => [
                'actions' => [
                    'index' => 'sms_template.index',
                    'create' => 'sms_template.create',
                    'edit' => 'sms_template.edit',
                    'trash' => 'sms_template.destroy',
                    'delete'  => 'sms_template.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index','edit'],
                ]
            ],
            'email_templates' => [
                'actions' => [
                    'index' => 'email_template.index',
                    'create' => 'email_template.create',
                    'trash' => 'email_template.destroy',
                    'edit' => 'email_template.edit',
                    'delete'  => 'email_template.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index','edit'],
                ]
            ],
            'push_notification_templates' => [
                'actions' => [
                    'index' => 'push_notification_template.index',
                    'create' => 'push_notification_template.create',
                    'trash' => 'push_notification_template.destroy',
                    'edit' => 'push_notification_template.edit',
                    'delete'  => 'push_notification_template.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index','edit'],
                ]
            ],
            'landing_page' => [
                'actions' => [
                    'index'   =>  'landing_page.index',
                    'edit'    =>  'landing_page.edit',
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'edit'],
                ]
            ],
            'appearance' => [
                'actions' => [
                    'index'   =>  'appearance.index',
                    'edit'    =>  'appearance.edit',
                    'create'  => 'appearance.create',
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'edit'],
                ]
            ],
            'backups' => [
                'actions' => [
                    'index'   => 'backup.index',
                    'create'  => 'backup.create',
                    'edit'    => 'backup.edit',
                    'trash'   => 'backup.destroy',
                    'restore' => 'backup.restore',
                    'delete'  => 'backup.forceDelete'
                ],
                'roles' => [
                    RoleEnum::ADMIN => ['index', 'create', 'edit', 'destroy', 'restore', 'forceDelete'],
                    RoleEnum::USER => ['index'],
                ]
            ],
        ];

        // Reset cached roles and permissions
        $userPermissions = [];
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        foreach ($modules as $key => $value) {
            Module::updateOrCreate(['name' => $key], ['name' => $key, 'actions' => $value['actions']]);
            foreach ($value['actions'] as $action => $permission) {
                if (!Permission::where('name', $permission)->first()) {
                    $permission = Permission::create(['name' => $permission]);
                }

                foreach ($value['roles'] as $role => $allowed_actions) {
                    if ($role == RoleEnum::USER) {
                        if (in_array($action, $allowed_actions)) {
                            $userPermissions[] = $permission;
                        }
                    }
                }
            }
        }
 
        $adminRole = Role::create([
            'name' => RoleEnum::ADMIN,
            'system_reserve' => true
        ]);

        $adminRole->givePermissionTo(Permission::all());

        $admin = User::factory()->create([
            'name' => "Administrator",
            'email' => 'admin@example.com',
            'password' => Hash::make('123456789'),
            'system_reserve' => true,
            'is_verified' => true,
        ]);
        $admin->assignRole($adminRole);

        $userRole = Role::create([
            'name' => RoleEnum::USER,
            'system_reserve' => true
        ]);
        $userRole->givePermissionTo($userPermissions);

        $user = User::factory()->create([
            'name' => "Joseph",
            'email' => 'joseph.user@example.com',
            'password' => Hash::make('123456789'),
            'system_reserve' => true,
            'created_by_id' => $admin?->id,
            'is_verified' => true,

        ]);
        $user->assignRole($userRole);
    }
}
