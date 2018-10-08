<?php

return [
    'admin_menu'  => [
        [
            'name'       => '主页',
            'url'        => '/admin/desk',
            'icon'       => 'fa fa-desktop',
            'permission' => 'admin_desk',
        ],
        [
            'name'       => '公司管理',
            'url'        => '#',
            'icon'       => 'fa fa-gear',
            'permission' => 'company_manage',
            'child'      => [
                [
                    'name'       => '公司列表',
                    'url'        => '/company/index',
                    'icon'       => 'fa fa-circle-o text-aqua',
                    'permission' => 'company_list',
                ],
            ],
        ]
        , [
            'name'       => '系统管理',
            'url'        => '#',
            'icon'       => 'fa fa-gear',
            'permission' => 'sys_manage',
            'child'      => [
                [
                    'name'       => '系统用户列表',
                    'url'        => '/admin/index',
                    'icon'       => 'fa fa-circle-o text-aqua',
                    'permission' => 'admin_list',
                ],
                // [
                //     'name'       => '系统设置',
                //     'url'        => '/setting/index',
                //     'icon'       => 'fa fa-circle-o text-aqua',
                //     'permission' => 'sys_setting',
                // ],
                [
                    'name'       => '角色列表',
                    'url'        => '/role/index',
                    'icon'       => 'fa fa-circle-o text-aqua',
                    'permission' => 'role_list',
                ],
            ],
        ],
    ],
    'client_menu' => [
        [
            'name'       => '主页',
            'url'        => '/client/desk',
            'icon'       => 'fa fa-desktop',
            'permission' => 'client_desk',
        ]
        , [
            'name'       => '店铺管理',
            'url'        => '#',
            'icon'       => 'fa fa-gear',
            'permission' => 'store_manage',
            'child'      => [
                [
                    'name'       => '店铺列表',
                    'url'        => '/store/index',
                    'icon'       => 'fa fa-circle-o text-aqua',
                    'permission' => 'store_list',
                ],
            ],
        ],
    ],
];