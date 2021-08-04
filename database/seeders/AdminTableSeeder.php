<?php

namespace Database\Seeders;

use App\Models\Auth\Menu;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 创建一个用户
//        User::truncate();
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'name' => '超级管理员',
            'permissions' => [],
        ]);

        // 创建角色
//        Role::truncate();
        Role::create([
            'name' => '超级管理员',
            'slug' => 'administrator',
            'permissions' => ["*"],
        ]);

        // 为用户添加角色
        User::first()->roles()->save(Role::first());

        // 添加默认菜单
//        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '首页',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => '系统',
                'icon' => 'fa-tasks',
                'uri' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => '管理员',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => '角色',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => '菜单',
                'icon' => 'fa-bars',
                'uri' => 'auth/menus',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => '日志',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
