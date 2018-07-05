<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 重置角色和权限的缓存
        app()['cache']->forget('spatie.permission.cache');

        $super = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);




        // 创建权限
//        Permission::create(['name' => 'edit articles']);
//        Permission::create(['name' => 'delete articles']);
//        Permission::create(['name' => 'publish articles']);
//        Permission::create(['name' => 'unpublish articles']);

        // 创建角色并赋予已创建的权限
//        $role = Role::create(['name' => 'writer']);
//        $role->givePermissionTo('edit articles');
//        $role->givePermissionTo('delete articles');

//        $role = Role::create(['name' => 'admin']);
//        $role->givePermissionTo('publish articles');
//        $role->givePermissionTo('unpublish articles');
    }
}
