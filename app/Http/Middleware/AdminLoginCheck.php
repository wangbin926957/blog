<?php
namespace App\Http\Middleware;

use App\Http\Controllers\Admin\BaseController;
use Closure;
use View;

class AdminLoginCheck {
    /**
     * 处理传入的请求
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // 管理后台登录验证
        $controller  = new BaseController();
        $login_admin = $controller->getLoginAdmin();

        if (empty($login_admin)) {
            $uri = $request->getRequestUri();
            session(['last_uri' => $uri]);
            return redirect('/login');
        } else {
            View::share('login_admin', $login_admin);
        }

        return $next($request);
    }

}