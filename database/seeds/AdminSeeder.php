<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            'account'    => 'amber',
            'salt'       => '123456',
            'group_id'   => 1,
            'role_id'    => 19,
            'name'       => '安培斯通',
            'created_at' => date('y-m-d H:i:s'),
            'updated_at' => date('y-m-d H:i:s'),
        ];

        $data['pwd'] = md5(md5('123456') . $data['salt']);

        DB::table('admins')->insert($data);
    }
}
