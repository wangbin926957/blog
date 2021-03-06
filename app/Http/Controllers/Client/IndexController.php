<?php
namespace App\Http\Controllers\Client;

use App\Services\MenuService;
use App\Services\UserService;
use Input;

/**
 * @author   Wangbin
 * @date     2018-10-10
 * @desc     主页 控制器
 * @version  1.0
 */
class IndexController extends BaseController {

    // 前台首页
    public function index() {
        $view_data = [];
        return view('client.index.index', $view_data);
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