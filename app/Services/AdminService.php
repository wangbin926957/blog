<?php
namespace App\Services;

use App\Models\Admin;

/**
 * 系统用户 服务层
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2017-12-12
 */
class AdminService extends BaseService {

    public function __construct() {
        $this->model = new Admin();
    }

    public function loginByAccount($account, $pwd) {
        $result = null;

        $filter = [
            'account' => $account,
        ];
        $obj = $this->exist($filter);

        if ($obj) {
            $tmp_pwd = $this->createPwd($pwd, $obj->salt);

            if ($tmp_pwd == $obj->pwd) {
                $result = $obj;
            }
        }

        return $result;
    }

    public function add($data) {
        $result = null;

        if ($data && !empty($data['password'])) {
            $data['salt'] = get_rand_numb();
            $data['pwd']  = $this->createPwd($data['password'], $data['salt']);

            $result = parent::add($data);
        }

        return $result;
    }

    public function edit($data) {
        $result = null;

        if ($data) {
            if (!empty($data['password'])) {
                $data['salt'] = get_rand_numb();
                $data['pwd']  = $this->createPwd($data['password'], $data['salt']);
            }

            $result = parent::edit($data);
        }

        return $result;
    }

    public function createPwd($pwd, $salt) {
        return md5(md5($pwd) . $salt);
    }
}