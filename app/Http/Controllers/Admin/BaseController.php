<?php

namespace App\Http\Controllers\Admin;

use App\Services\RoleService;
use Illuminate\Routing\Controller;

/**
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2018-7-30
 * @desc     控制器 基类
 * @version  1.0
 */
class BaseController extends Controller {

    // 是否登录
    public function isLogin() {
        $result = false;
        $user   = session('login_admin');

        if ($user) {
            $result = true;
        }

        return $result;
    }

    // session保存登录信息
    public function setLoginAdmin($user) {
        if ($user) {
            session(['login_admin' => $user]);
        }
    }

    // 获取登录用户
    public function getLoginAdmin() {
        $result = session('login_admin');

        return $result;
    }

    public function getLoginAdminId() {
        $result = null;
        $user   = $this->getLoginAdmin();

        if ($user) {
            $result = $user->id;
        }

        return $result;
    }

    // 获取用户权限列表
    public function getAdminPermission() {
        $result    = [];
        $loginUser = $this->getLoginAdmin();

        if ($loginUser) {
            $role_id = $loginUser->role_id;

            if ($role_id) {
                $permissions = RoleService::getPermissionsBy($role_id);
                $result      = $permissions;
            }
        }

        return $result;
    }

    // 返回json
    public function toJson($code, $data = null, $msg = '') {
        $result = [
            'code' => $code,
            'msg'  => trans('msg.' . $code),
        ];

        if ($data) {
            $result['data'] = $data;
        }

        return response()->json($result);
    }
}