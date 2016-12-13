<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $system = Menu::create([
            'name' => '系统管理',
            'parent_id' => '0',
            'slug' => 'system.manage',
            'url' => 'admin/menu',
            'icon' => 'fa fa-gear',
            'heightlight_url' => 'admin/menu*,admin/user*,admin/role*,admin/permission*,admin/admin*',
        ]);
        Menu::create([
            'name' => '菜单管理',
            'parent_id' => $system->id,
            'slug' => 'menu.list',
            'url' => 'admin/menu',
            'heightlight_url' => 'admin/menu*',
        ]);
        Menu::create([
            'name' => '管理员',
            'parent_id' => $system->id,
            'slug' => 'admin.list',
            'url' => 'admin/admin',
            'heightlight_url' => 'admin/admin*',
        ]);
        Menu::create([
            'name' => '权限管理',
            'parent_id' => $system->id,
            'slug' => 'permission.list',
            'url' => 'admin/permission',
            'heightlight_url' => 'admin/permission*',
        ]);
        Menu::create([
            'name' => '角色管理',
            'parent_id' => $system->id,
            'slug' => 'role.list',
            'url' => 'admin/role',
            'heightlight_url' => 'admin/role*',
        ]);
        Menu::create([
            'name' => '用户列表',
            'parent_id' => $system->id,
            'slug' => 'user.list',
            'url' => 'admin/user',
            'heightlight_url' => 'admin/user*',
        ]);

    }
}
