<?php
namespace App\Http\Controllers\Admin;

use App\Services\AdminService;
use App\Services\MenuService;
use Input;

/**
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2018-7-30
 * @desc     控制器 基类
 * @version  1.0
 */
class IndexController extends BaseController {

    // 管理后台主页
    public function index() {
        if ($this->isLogin()) {
            $login_admin = $this->getLoginAdmin();
            $menus       = [];

            if ($login_admin && $login_admin->role_id) {
                $menus = MenuService::getMenusByRole($login_admin->role_id);
            }

            $view_data['menus'] = $menus;

            return view('admin.index', $view_data);
        } else {
            return redirect('/login');
        }
    }

    // 登录
    public function login() {
        $view_data = [];

        if (IS_POST) {
            $account = Input::get('account');
            $pwd     = Input::get('pwd');
            $service = new AdminService();

            $admin = $service->loginByAccount($account, $pwd);
            // dd($admin);
            if (empty($admin)) {
                //用户不存在
                $code = 1001;
            }
            // 账号禁用
            elseif ($admin->disabled == 1) {
                //用户被锁定
                $code = 1002;
            } elseif ($admin) {
                $this->setLoginAdmin($admin);
                return redirect('/');
            }

            $view_data['account'] = $account;
        }

        if ($this->isLogin()) {
            return redirect('/');
        }

        $view_data['msg'] = empty($code) ? '' : trans('msg.' . $code);

        return view('admin.login', $view_data);
    }

    // 退出
    public function logout() {
        session()->flush();
        return redirect('/login');
    }

}