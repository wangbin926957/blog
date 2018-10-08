<?php
namespace App\Http\Controllers\Admin;

use App\Services\AdminService;
use App\Services\RoleService;
use Input;

/**
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2017-12-12
 * @desc     系统用户 控制器
 * @version  1.0
 */
class AdminController extends BaseController {

    // 系统用户 列表
    public function index() {
        $service = new AdminService();

        $filter = [];
        $sort   = [
            'id' => 'desc',
        ];
        $data              = $service->page($filter, $sort);
        $view_data['data'] = $data;

        // 系统用户角色
        $roles              = RoleService::getSysRoles();
        $view_data['roles'] = $roles;

        return view('admin.admin_user.index', $view_data);
    }

    public function save() {

        if (IS_POST) {
            $code    = 101;
            $service = new AdminService();
            $data    = Input::all();
            $id      = Input::get('id');

            if (empty($data['account'])) {
                $code = 1101;
                return $this->toJson($code);
            }

            // 添加数据 密码必填
            if (empty($id) && empty($data['password'])) {
                $code = 1102;
                return $this->toJson($code);
            }

            // 账号重复验证
            $_tmp = $service->exist([
                'account' => $data['account'],
            ]);

            if ($_tmp && $_tmp->id != $id) {
                $code = 1103;
                return $this->toJson($code);
            }

            if (empty($id)) {
                $data['add_by'] = $this->getLoginAdminId();
                $r              = $service->add($data);

                if ($r) {
                    $code = 0;
                }

            } else {
                $data['edit_by'] = $this->getLoginAdminId();
                $r               = $service->edit($data);

                if ($r) {
                    $code = 0;
                }
            }

            return $this->toJson($code);
        }

    }

    public function info() {
        $code    = 0;
        $service = new AdminService();
        $id      = Input::get('id');
        $obj     = $service->getById($id);

        if (empty($obj)) {
            $code = 1104;
        }

        return $this->toJson($code, $obj);
    }

// 用户桌面
    public function desk() {
        // regions 数据
        echo 'desk';
    }

}