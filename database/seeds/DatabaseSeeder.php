<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // 系统用户默认数据
        $this->call(AdminSeeder::class);
        // 超级管理员默认权限
        $this->call(RolePermissionSeeder::class);
        // 省市区数据
        $this->call(RegionSeeder::class);
    }
}
