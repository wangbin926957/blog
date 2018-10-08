<?php

namespace App\Http\Controllers\API;

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
        $user   = session('admin_login_user');

        if ($user) {
            $result = true;
        }

        return $result;
    }

    // session保存登录信息
    public function setLoginUser($user) {
        if ($user) {
            session(['admin_login_user' => $user]);
        }
    }

    // 获取登录用户
    public function getLoginUser() {
        $result = session('admin_login_user');

        return $result;
    }

    public function getLoginUserId() {
        $result = null;
        $user   = $this->getLoginUser();

        if ($user) {
            $result = $user->id;
        }

        return $result;
    }

    // 获取用户权限列表
    public function getUserPermission() {
        $result    = [];
        $loginUser = $this->getLoginUser();

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