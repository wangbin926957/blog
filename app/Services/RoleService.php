<?php

namespace App\Services;

use App\Models\RolePermission;
use Cache;

/**
 * 角色 服务层
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2017-06-08
 */
class RoleService {
    // 获取所有角色
    public static function getAllRoles() {
        $result = [];
        $groups = config('role');
        $roles  = [];

        foreach ($groups as $k => $g) {
            if (!empty($g['roles'])) {
                $roles = array_merge($roles, $g['roles']);
            }
        }

        $tmp    = collect($roles);
        $result = $tmp->keyBy('role_id')->toArray();

        return $result;
    }

    // 获取所有角色id数组
    public static function getRoleIdArray() {
        $roles  = self::getAllRoles();
        $result = array_column($roles, 'role_id');

        return $result;
    }

    // 获取系统用户角色
    public static function getSysRoles() {
        $result = [];
        $data   = config('role.system_group');
        $roles  = $data['roles'];
        $tmp    = collect($roles);
        $result = $tmp->keyBy('role_id');

        return $result;
    }

    // 获取 CRM客户端 用户角色
    public static function getClientRoles() {
        $result = [];
        $data   = config('role.client_group');
        $roles  = $data['roles'];
        $tmp    = collect($roles);
        $result = $tmp->keyBy('role_id');

        return $result;
    }

    // 根据id获取角色信息
    public static function getRoleById($id) {
        $result = [];
        $roles  = RoleService::getAllRoles();

        if (isset($roles[$id])) {
            $result = $roles[$id];
        }

        return $result;
    }

    // 保存角色权限
    public static function setRolePermissions($data) {
        $result      = null;
        $role_id_arr = self::getRoleIdArray();

        if (isset($data['role_id']) && in_array($data['role_id'], $role_id_arr)) {
            $role_id = $data['role_id'];

            // permissions 数组
            $permissions = [];

            if (isset($data['permissions']) && is_array($data['permissions'])) {
                $permissions = $data['permissions'];
            }

            // 角色权限记录
            $role_permissions = RolePermission::where('role_id', $data['role_id'])
                ->first();

            // 修改
            if ($role_permissions) {
                $role_permissions->permissions = json_encode($permissions);
                $r                             = $role_permissions->save();

                if ($r) {
                    // 更新角色权限缓存
                    RoleService::setCache($role_id, $permissions);
                    $result = $role_permissions;
                }
            }
            // 添加
            else {
                $role_permissions = [
                    'role_id' => $data['role_id']
                    , 'permissions' => json_encode($permissions),
                ];

                $result = RolePermission::create($role_permissions);

                if ($result) {
                    // 更新角色权限缓存
                    RoleService::setCache($role_id, $permissions);
                }
            }
        }

        return $result;
    }

    // 根据系统用户id 获取用户权限
    public static function getPermissionsBy($role_id) {
        $result      = [];
        $role_id_arr = self::getRoleIdArray();

        if (in_array($role_id, $role_id_arr)) {
            $cache = RoleService::getCache($role_id);

            if (empty($cache)) {
                $role_permissions = RolePermission::where('role_id', $role_id)
                    ->first();

                if ($role_permissions) {
                    $tmp         = json_decode($role_permissions['permissions'], true);
                    $permissions = $tmp ? $tmp : [];
                    $result      = $permissions;

                    RoleService::setCache($role_id, $permissions);
                }
            } else {
                $result = $cache;
            }
        }

        return $result;
    }

    // 设置角色权限缓存
    private static function setCache($role_id, $permissions) {
        $role_id_arr = self::getRoleIdArray();

        if (in_array($role_id, $role_id_arr)) {
            $cache_key = 'role_permissions_' . $role_id;
            Cache::forever($cache_key, $permissions);
        }
    }

    // 获取角色权限缓存
    private static function getCache($role_id) {
        $result      = [];
        $role_id_arr = self::getRoleIdArray();

        if (in_array($role_id, $role_id_arr)) {
            $cache_key = 'role_permissions_' . $role_id;

            $cache = Cache::get($cache_key);

            if ($cache) {
                $result = $cache;
            }
        }

        return $result;
    }
}