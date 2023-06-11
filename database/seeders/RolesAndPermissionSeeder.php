<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-ticket']);
        Permission::create(['name' => 'edit-ticket']);
        Permission::create(['name' => 'resolve-ticket']);
        Permission::create(['name' => 'delete-ticket']);
        Permission::create(['name' => 'view-ticket']);

        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);

        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $adminRole = Role::create(['name' => 'Admin']);
        $supportRole = Role::create(['name' => 'Support Agent']);
        $customerRole = Role::create(['name' => 'Customer']);

        $superAdminRole->givePermissionTo([

        ]);

        $adminRole->givePermissionTo([
            'create-ticket',
            'edit-ticket',
            'resolve-ticket',
            'delete-ticket',
        ]);

        $supportRole->givePermissionTo([
            'create-ticket',
            'edit-ticket',
            'view-ticket',
            'resolve-ticket'
        ]);

        $customerRole->givePermissionTo([
            'create-ticket',
            'view-ticket',
        ]);
    }
}
