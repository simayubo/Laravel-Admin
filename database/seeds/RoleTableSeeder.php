<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;  //引入权限Model
use App\Models\Role; //引入角色Model

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role;
        $admin->name         = 'admin';
        $admin->display_name = '超级管理员';
        $admin->description  = '超级管理员';
        $admin->save();
        $owner = new Role;
        $owner->name         = 'user';
        $owner->display_name = '普通管理';
        $owner->description  = '普通管理';
        $owner->save();
        $allPermission = array_column(Permission::all()->toArray(), 'id');
        $admin->perms()->sync($allPermission);
        // 普通管理
        $createUser = Permission::where('display_name','添加菜单')->first();
        $loginBackend = Permission::where('name','system.login')->first();
        $owner->attachPermissions([$createUser,$loginBackend]);
    }
}
