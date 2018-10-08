<?php
namespace App\Services;

use App\Services\MenuService;

/**
 * 菜单 服务层
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2017-06-08
 */
class MenuService extends BaseService {
    // 获取管理后台菜单
    public static function getAdminMenus() {
        $result = array();
        $data   = config('menu.admin_menu');

        return $data;
    }

    // 根据角色获取菜单
    public static function getMenusByRole($role_id) {
        $menus       = [];
        $all_menus   = MenuService::getAdminMenus();
        $permissions = RoleService::getPermissionsBy($role_id);

        foreach ($all_menus as $key => $value) {
            if (isset($value['permission']) && in_array($value['permission'], $permissions)) {

                $root = [
                    'name' => $value['name']
                    , 'url' => $value['url']
                    , 'icon' => $value['icon'],
                ];

                if (isset($value['child'])) {
                    $child = [];

                    foreach ($value['child'] as $k => $v) {
                        if (isset($v['permission']) && in_array($v['permission'], $permissions)) {
                            $child[] = [
                                'name' => $v['name']
                                , 'url' => $v['url']
                                , 'icon' => $v['icon'],
                            ];
                        }
                    }

                    $root['child'] = $child;
                }

                $menus[] = $root;
            }
        }

        return $menus;
    }
}
