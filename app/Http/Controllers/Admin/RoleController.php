<?php
namespace App\Http\Controllers\Admin;

use App\Services\PermissionService;
use App\Services\RoleService;
use Input;

/**
 * 角色 控制器
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2018-01-06
 */
class RoleController extends BaseController {

    // 角色列表
    public function index() {
        // 管理后台 用户角色
        $admin_roles = RoleService::getSysRoles();
        // CRM客户端 用户角色
        $client_roles = RoleService::getClientRoles();

        $view_data = [
            'admin_roles'  => $admin_roles,
            'client_roles' => $client_roles,
        ];

        return view('admin.role.index', $view_data);
    }

    // 角色授权
    public function permission() {
        $role_id = Input::get('role_id');

        if ($role_id) {
            $role_info = RoleService::getRoleById($role_id);
        }

        if (empty($role_info)) {
            return redirect('/role/index');
        }

        $view_data['role_info'] = $role_info;

        if (IS_POST) {
            $role_id     = Input::get('role_id');
            $permissions = Input::get('permissions', []);

            $role_permissions = [
                'role_id' => $role_id
                , 'permissions' => $permissions,
            ];

            $service = new RoleService();
            $r       = $service->setRolePermissions($role_permissions);

            if ($r) {
                $view_data['msg'] = '保存成功';
            } else {
                $view_data['msg'] = '保存失败';
            }
        }

        // 权限
        $data = [];

        $data = PermissionService::getAdminPermission();

        $view_data['data'] = $data;

        // 获取角色对应的权限
        $role_permissions              = RoleService::getPermissionsBy($role_id);
        $view_data['role_permissions'] = json_encode($role_permissions);

        return view('admin.role.permission', $view_data);
    }

    public function clientPermission() {
        $role_id = Input::get('role_id');

        if ($role_id) {
            $role_info = RoleService::getRoleById($role_id);
        }

        if (empty($role_info)) {
            return redirect('/role/index');
        }

        $view_data['role_info'] = $role_info;

        if (IS_POST) {
            $role_id     = Input::get('role_id');
            $permissions = Input::get('permissions', []);

            $role_permissions = [
                'role_id' => $role_id
                , 'permissions' => $permissions,
            ];

            $service = new RoleService();
            $r       = $service->setRolePermissions($role_permissions);

            if ($r) {
                $view_data['msg'] = '保存成功';
            } else {
                $view_data['msg'] = '保存失败';
            }
        }

        // 权限
        $data = [];

        $data = PermissionService::getClientPermission();

        $view_data['data'] = $data;

        // 获取角色对应的权限
        $role_permissions              = RoleService::getPermissionsBy($role_id);
        $view_data['role_permissions'] = json_encode($role_permissions);

        return view('admin.role.permission', $view_data);
    }
}