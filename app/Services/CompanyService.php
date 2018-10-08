<?php
namespace App\Services;

use App\Models\Company;

/**
 * 系统用户 服务层
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2017-12-12
 */
class CompanyService extends BaseService {

    public function __construct() {
        $this->model = new Company();
    }
}