<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         //create role
         $superAdmin = Role::create(['name' => 'superadmin']);
         $admin = Role::create(['name' => 'admin']);
         $editor = Role::create(['name' => 'editor']);
         $user = Role::create(['name' => 'user']);

         //permissions
         $permissions = [
            'dashboard.view',

            'blog.view',
            'blog.edit',
            'blog.update',
            'blog.delete',
            'blog.approve',

            'admin.view',
            'admin.edit',
            'admin.update',
            'admin.delete',
            'admin.approve',

            'role.view',
            'role.edit',
            'role.update',
            'role.delete',
            'role.approve',

            'profile.view',
            'profile.edit'
        ];

        // permission create and and  role has permission create

        foreach($permissions as $permission){
            $permission = Permission::create(['name' =>$permission]);

            $superAdmin->givePermissionTo($permission);
            // $permission->assignRole($superAdmin);
        }
    }
}
