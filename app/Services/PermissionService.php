<?php
namespace App\Services;

/**
 * 权限 服务层
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2017-06-08
 */
class PermissionService {
    // 获取 管理后台权限列表
    public static function getAdminPermission() {
        $result = config('permission.admin_permissions');

        return $result;
    }

    // 获取 web版权限列表
    public static function getClientPermission() {
        $result = config('permission.client_permissions');

        return $result;
    }
}