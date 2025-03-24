<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultDataUsersTableSeeder extends Seeder
{
    public function run()
    {
        // Default All Permission
        $allPermission = [
            [
                'name' => 'manage user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage contact',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create contact',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit contact',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete contact',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage note',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create note',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit note',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete note',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage logged history',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete logged history',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'buy pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage pricing transation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage coupon',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create coupon',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit coupon',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete coupon',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage coupon history',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete coupon history',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage account settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage password settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage general settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage company settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage email settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage payment settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage seo settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage google recaptcha settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage notification',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'edit notification',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage FAQ',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create FAQ',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit FAQ',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete FAQ',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage Page',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create Page',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit Page',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete Page',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show Page',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage home page',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit home page',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage footer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit footer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage 2FA settings',
                'guard_name' => 'web',
            ],

            [
                'name' => 'manage category',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create category',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'edit category',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'delete category',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage sub category',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create sub category',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'edit sub category',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'delete sub category',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage tag',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create tag',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'edit tag',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'delete tag',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'edit document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'delete document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'show document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage my document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'edit my document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'delete my document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'show my document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create my document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage reminder',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create reminder',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'edit reminder',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'delete reminder',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'show reminder',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage my reminder',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage document history',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'download document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'preview document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage comment',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create comment',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage version',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create version',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage share document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'delete share document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'create share document',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage mail',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'send mail',
                'gaurd_name' => 'web',
            ],
            [
                'name' => 'manage auth page',
                'gaurd_name' => 'web',
            ],

        ];
        Permission::insert($allPermission);

        // Default Super Admin Role
        $superAdminRoleData =  [
            'name' => 'super admin',
            'parent_id' => 0,
        ];
        $systemSuperAdminRole = Role::create($superAdminRoleData);
        $systemSuperAdminPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'show user'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'manage pricing packages'],
            ['name' => 'create pricing packages'],
            ['name' => 'edit pricing packages'],
            ['name' => 'delete pricing packages'],
            ['name' => 'manage pricing transation'],
            ['name' => 'manage coupon'],
            ['name' => 'create coupon'],
            ['name' => 'edit coupon'],
            ['name' => 'delete coupon'],
            ['name' => 'manage coupon history'],
            ['name' => 'delete coupon history'],
            ['name' => 'manage account settings'],
            ['name' => 'manage password settings'],
            ['name' => 'manage general settings'],
            ['name' => 'manage email settings'],
            ['name' => 'manage payment settings'],
            ['name' => 'manage seo settings'],
            ['name' => 'manage google recaptcha settings'],
            ['name' => 'manage FAQ'],
            ['name' => 'create FAQ'],
            ['name' => 'edit FAQ'],
            ['name' => 'delete FAQ'],
            ['name' => 'manage Page'],
            ['name' => 'create Page'],
            ['name' => 'edit Page'],
            ['name' => 'delete Page'],
            ['name' => 'show Page'],
            ['name' => 'manage home page'],
            ['name' => 'edit home page'],
            ['name' => 'manage footer'],
            ['name' => 'edit footer'],
            ['name' => 'manage 2FA settings'],
            ['name' => 'manage auth page'],
        ];
        $systemSuperAdminRole->givePermissionTo($systemSuperAdminPermission);
        // Default Super Admin
        $superAdminData =     [
            'first_name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('123456'),
            'type' => 'super admin',
            'lang' => 'english',
            'email_verified_at' => now(),
            'profile' => 'avatar.png',
        ];
        $systemSuperAdmin = User::create($superAdminData);
        $systemSuperAdmin->assignRole($systemSuperAdminRole);
        HomePageSection();
        CustomPage();
        DefaultBankTransferPayment();
        authPage($systemSuperAdmin->id);

        // Default Owner Role
        $ownerRoleData = [
            'name' => 'owner',
            'parent_id' => $systemSuperAdmin->id,
        ];
        $systemOwnerRole = Role::create($ownerRoleData);

        // Default Owner All Permissions
        $systemOwnerPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'manage role'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'delete role'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'manage logged history'],
            ['name' => 'delete logged history'],
            ['name' => 'manage pricing packages'],
            ['name' => 'buy pricing packages'],
            ['name' => 'manage pricing transation'],
            ['name' => 'manage account settings'],
            ['name' => 'manage password settings'],
            ['name' => 'manage general settings'],
            ['name' => 'manage company settings'],
            ['name' => 'manage email settings'],
            ['name' => 'manage notification'],
            ['name' => 'edit notification'],
            ['name' => 'manage 2FA settings'],

            ['name' => 'manage category'],
            ['name' => 'create category'],
            ['name' => 'edit category'],
            ['name' => 'delete category'],
            ['name' => 'manage sub category'],
            ['name' => 'create sub category'],
            ['name' => 'edit sub category'],
            ['name' => 'delete sub category'],
            ['name' => 'manage tag'],
            ['name' => 'create tag'],
            ['name' => 'edit tag'],
            ['name' => 'delete tag'],
            ['name' => 'manage document'],
            ['name' => 'create document'],
            ['name' => 'edit document'],
            ['name' => 'delete document'],
            ['name' => 'show document'],
            ['name' => 'manage my document'],
            ['name' => 'edit my document'],
            ['name' => 'delete my document'],
            ['name' => 'show my document'],
            ['name' => 'create my document'],
            ['name' => 'manage reminder'],
            ['name' => 'create reminder'],
            ['name' => 'edit reminder'],
            ['name' => 'delete reminder'],
            ['name' => 'show reminder'],
            ['name' => 'manage my reminder'],
            ['name' => 'manage document history'],
            ['name' => 'download document'],
            ['name' => 'preview document'],
            ['name' => 'manage comment'],
            ['name' => 'create comment'],
            ['name' => 'manage version'],
            ['name' => 'create version'],
            ['name' => 'manage share document'],
            ['name' => 'delete share document'],
            ['name' => 'create share document'],
            ['name' => 'manage mail'],
            ['name' => 'send mail'],

        ];
        $systemOwnerRole->givePermissionTo($systemOwnerPermission);

        // Default Owner Create
        $ownerData =    [
            'first_name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('123456'),
            'type' => 'owner',
            'lang' => 'english',
            'email_verified_at' => now(),
            'profile' => 'avatar.png',
            'subscription' => 1,
            'parent_id' => $systemSuperAdmin->id,
        ];
        $systemOwner = User::create($ownerData);
        // Default Template Assign
        defaultTemplate($systemOwner->id);
        // Default Owner Role Assign
        $systemOwner->assignRole($systemOwnerRole);


        // Default Owner Role
        $managerRoleData =  [
            'name' => 'manager',
            'parent_id' => $systemOwner->id,
        ];
        $systemManagerRole = Role::create($managerRoleData);
        // Default Manager All Permissions
        $systemManagerPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'manage 2FA settings'],

            ['name' => 'manage category'],
            ['name' => 'create category'],
            ['name' => 'edit category'],
            ['name' => 'delete category'],
            ['name' => 'manage sub category'],
            ['name' => 'create sub category'],
            ['name' => 'edit sub category'],
            ['name' => 'delete sub category'],
            ['name' => 'manage tag'],
            ['name' => 'create tag'],
            ['name' => 'edit tag'],
            ['name' => 'delete tag'],
            ['name' => 'manage document'],
            ['name' => 'create document'],
            ['name' => 'edit document'],
            ['name' => 'delete document'],
            ['name' => 'show document'],
            ['name' => 'manage my document'],
            ['name' => 'edit my document'],
            ['name' => 'delete my document'],
            ['name' => 'show my document'],
            ['name' => 'create my document'],
            ['name' => 'manage reminder'],
            ['name' => 'create reminder'],
            ['name' => 'edit reminder'],
            ['name' => 'delete reminder'],
            ['name' => 'show reminder'],
            ['name' => 'manage my reminder'],
            ['name' => 'manage document history'],
            ['name' => 'download document'],
            ['name' => 'preview document'],
            ['name' => 'manage comment'],
            ['name' => 'create comment'],
            ['name' => 'manage version'],
            ['name' => 'create version'],
            ['name' => 'manage share document'],
            ['name' => 'delete share document'],
            ['name' => 'create share document'],
            ['name' => 'manage mail'],
            ['name' => 'send mail'],

        ];
        $systemManagerRole->givePermissionTo($systemManagerPermission);

        // Default Manager Create
        $managerData =   [
            'first_name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('123456'),
            'type' => 'manager',
            'lang' => 'english',
            'email_verified_at' => now(),
            'profile' => 'avatar.png',
            'subscription' => 0,
            'parent_id' => $systemOwner->id,
        ];
        $systemManager = User::create($managerData);
        // Default Manager Role Assign
        $systemManager->assignRole($systemManagerRole);

        // Subscription default data
        $subscriptionData = [
            'title' => 'Basic',
            'package_amount' => 0,
            'interval' => 'Unlimited',
            'user_limit' => 10,
            'document_limit' => 10,
            'enabled_document_history' => 1,
            'enabled_logged_history' => 1,
    ];
        \App\Models\Subscription::create($subscriptionData);
    }
}
