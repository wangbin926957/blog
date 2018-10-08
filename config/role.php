<?php

return [
    // 系统用户
    'system_group' => [
        'group_id'   => 1,
        'group_name' => '系统角色',
        'roles'      => [
            [
                'role_id'   => 11,
                'role_name' => '客服',
            ],
            [
                'role_id'   => 19,
                'role_name' => '系统管理员',
            ],
        ],
    ],
    'client_group' => [
        'group_id'   => 2,
        'group_name' => '用户角色',
        'roles'      => [
            [
                'role_id'   => 21,
                'role_name' => '销售',
            ],
            [
                'role_id'   => 22,
                'role_name' => '代理商',
            ],
            [
                'role_id'   => 23,
                'role_name' => '门店',
            ],
        ],
    ],
];