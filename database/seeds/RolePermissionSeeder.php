<?php

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            'role_id'     => 19,
            'permissions' => json_encode([
                'sys_manage',
                'admin_list',
                'sys_setting',
                'role_list',
                'set_role_permission',
            ]),
            'created_at'  => date('y-m-d H:i:s'),
            'updated_at'  => date('y-m-d H:i:s'),
        ];

        DB::table('role_permissions')->insert($data);
    }
}
