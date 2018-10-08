<?php
namespace App\Http\Controllers\Client;

use App\Services\MenuService;
use App\Services\UserService;
use Input;

/**
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2018-7-30
 * @desc     主页 控制器
 * @version  1.0
 */
class IndexController extends BaseController {

    // 管理后台主页
    public function index() {
        if ($this->isLogin()) {
            $login_user = $this->getLoginUser();
            $role_id    = $login_user->role_id ?? '';
            $menus      = [];

            if ($role_id) {
                $menus = MenuService::getMenusByClient($role_id);
            }

            $view_data['menus'] = $menus;

            return view('admin.index', $view_data);
        } else {
            return redirect('/login');
        }
    }

    // 登录
    public function login() {
        if (IS_POST) {
            $account = Input::get('account');
            $pwd     = Input::get('pwd');
            $service = new UserService();

            $user = $service->loginByAccount($account, $pwd);

            if (empty($user)) {
                //用户不存在
                $code = 100001;
            } elseif ($user->disabled == 1) {
                //用户被锁定
                $code = 100002;
            } elseif ($user) {
                $this->setLoginUser($user);
                return redirect('/');
            } else {
                $code = 100001;
            }

            $view_data['account'] = $account;
        }

        if ($this->isLogin()) {
            return redirect('/');
        }

        $view_data['msg'] = empty($code) ? '' : trans('msg.' . $code);

        return view('client.login', $view_data);
    }

    // 退出
    public function logout() {
        session()->flush();
        return redirect('/login');
    }

}