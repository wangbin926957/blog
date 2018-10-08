<?php

return [
    // 系统管理后台权限
    'admin_permissions'  => [
        [
            'name'       => '主页',
            'permission' => 'admin_desk',
            'child'      => [],
        ],
        [
            'name' => '企业管理'
            , 'permission' => 'company_manage'
            , 'child' => [
                [
                    'name' => '企业列表'
                    , 'permission' => 'company_list',
                ]
                , [
                    'name' => '添加企业'
                    , 'permission' => 'company_add',
                ]
                , [
                    'name' => '修改企业'
                    , 'permission' => 'company_edit',
                ],
            ],
        ],
        [
            'name' => '系统管理'
            , 'permission' => 'sys_manage'
            , 'child' => [
                [
                    'name' => '系统用户列表'
                    , 'permission' => 'admin_list',
                ]
                , [
                    'name' => '添加用户'
                    , 'permission' => 'admin_add',
                ]
                , [
                    'name' => '修改用户'
                    , 'permission' => 'admin_edit',
                ]
                , [
                    'name' => '系统设置'
                    , 'permission' => 'sys_setting',
                ]
                , [
                    'name' => '角色列表'
                    , 'permission' => 'role_list',
                ]
                , [
                    'name' => '分配权限'
                    , 'permission' => 'set_role_permission',
                ],
            ],
        ],
    ],

    // 客户端权限
    'client_permissions' => [
        [
            'name'       => '主页',
            'permission' => 'client_desk',
            'child'      => [],
        ]
        , [
            'name' => '店铺管理'
            , 'permission' => 'store_manage'
            , 'child' => [
                [
                    'name' => '店铺列表'
                    , 'permission' => 'store_list',
                ]
                , [
                    'name' => '添加店铺'
                    , 'permission' => 'store_add',
                ]
                , [
                    'name' => '修改店铺'
                    , 'permission' => 'store_edit',
                ],
            ],
        ],
    ],
];