<?php

use Illuminate\Database\Seeder;
use App\Models\Role;  //引入角色Model

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();
        $admin = factory('App\Admin')->create([
            'name' => 'admin',
            'email' => 'simayubo@gmail.com',
            'password' => bcrypt('123456')
        ])->each(function($u) use ($adminRole){
            // $u->roles()->attach([$admin->id]);
            $u->attachRole($adminRole);
        });
        $users = factory('App\Admin',3)->create([
            'password' => bcrypt('123456')
        ])->each(function($u) use ($userRole){
            $u->roles()->attach([$userRole->id]);
        });
    }
}
