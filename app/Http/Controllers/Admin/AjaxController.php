<?php
namespace App\Http\Controllers\Admin;

use App\Services\RegionService;

/**
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2017-06-08
 * @desc     通用 Ajax 控制器
 * @version  1.0
 */
class AjaxController extends BaseController {

    public function isLogin() {
        // 登录验证
        $result = array(
            'is_login' => parent::isLogin(),
        );

        return response()->json($result);
    }

    public function getRegion() {
        $result = RegionService::getRegionData();

        return response()->json($result);
    }
}