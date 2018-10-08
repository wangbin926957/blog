<?php
namespace App\Http\Controllers\Admin;

use App\Services\CompanyService;
use Input;

/**
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2018-8-3
 * @desc     企业 控制器
 * @version  1.0
 */
class CompanyController extends BaseController {

    // 系统用户 列表
    public function index() {

        $service = new CompanyService();

        $filter = [];
        $sort   = [
            'id' => 'desc',
        ];
        $data              = $service->all($filter, $sort);
        $view_data['data'] = $data;

        return view('admin.company.index', $view_data);
    }

    public function save() {

        if (IS_POST) {
            $code    = 101;
            $service = new CompanyService();
            $data    = Input::all();
            $id      = Input::get('id');

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
        $service = new CompanyService();
        $id      = Input::get('id');
        $obj     = $service->getById($id);

        if (empty($obj)) {
            $code = 100103;
        }

        return $this->toJson($code, $obj);
    }

}