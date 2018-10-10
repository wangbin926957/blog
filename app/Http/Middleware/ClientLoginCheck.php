<?php
namespace App\Http\Middleware;

use App\Http\Controllers\Client\BaseController;
use Closure;
use View;

class ClientLoginCheck {
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
        $login_user = $controller->getLoginUser();

        if (empty($login_admin)) {
            $uri = $request->getRequestUri();
            session(['last_uri' => $uri]);
            return redirect('/login');
        } else {
            View::share('login_user', $login_user);
        }

        return $next($request);
    }

}