<?php
namespace App\Services;

/**
 * 服务层 父类
 * @author   Michael Liang    <liang15946@163.com>
 * @date     2017-10-17
 */
class BaseService {

    protected $model;

    protected function isModelField($key) {
        $result = false;

        if ($this->model && in_array($key, $this->model->fillable)) {
            $result = true;
        }

        return $result;
    }

    public function all($filter = [], $sorts = []) {
        $query = $this->model->select();

        // 添加 筛选条件
        $this->_append_filter($query, $filter);

        // 添加 排序字段
        $this->_append_sort($query, $sorts, $filter);

        $result = $query->get();

        return $result;
    }

    /**
     * 通用分页方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     * $filter      筛选条件
     * $sorts       排序字段
     * $page_size   单页数量
     */
    public function page($filter = [], $sorts = [], $page_size = null) {
        // $sorts 参数当 $page_size 使用
        if (is_null($page_size) && is_int($sorts)) {
            $page_size = $sorts;
        }

        // 默认分页数量
        if (empty($page_size)) {
            $page_size = config('const.page_size', 15);
        }

        $query = $this->model->select();

        // 添加 筛选条件
        $this->_append_filter($query, $filter);

        // 添加 排序字段
        $this->_append_sort($query, $sorts);

        // 分页查询
        $result = $query->paginate($page_size);

        // 保存筛选条件
        return $result;
    }

    /**
     * 通用添加方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     * $data        添加数据
     */
    public function add($data) {
        $result = null;

        if (is_array($data)) {
            $add_data = [];
            foreach ($data as $key => $value) {

                if ($this->isModelField($key)) {
                    $add_data[$key] = $value;
                }
            }

            $obj = $this->model->create($add_data);

            if ($obj) {
                $result = $obj;
            }
        }

        return $result;
    }

    /**
     * 通用修改方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     * $data        修改数据
     */
    public function edit($data) {
        $result = null;

        if (isset($data['id'])) {
            $id  = $data['id'];
            $obj = $this->model->find($id);

            if ($obj) {
                foreach ($data as $key => $value) {
                    if ($this->isModelField($key)) {
                        $obj->$key = $value;
                    }
                }

                $obj->save();
            }

            $result = $obj;
        }

        return $result;
    }

    /**
     * 数据是否存在判断 通用方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     * $data        修改数据
     */
    public function exist($filter = []) {
        $result = null;

        if (is_array($filter) && $this->model) {
            $query = $this->model->select();

            $this->_append_filter($query, $filter);

            $query = $query->orderBy($this->model->primaryKey, 'desc');

            $result = $query->first();
        }

        return $result;
    }

    /**
     * 通用查询多条数据方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     */
    public function top($filter = [], $sorts = [], $count = 15) {
        $query = $this->model->select();

        $this->_append_filter($query, $filter);

        if ($sorts) {
            foreach ($sorts as $key => $value) {
                $query->orderBy($key, $value);
            }
        } else {
            // 默认按主键排序
            $sort = $this->model->primaryKey;

            if (!empty($filter['sort']) && $this->isModelField($filter['sort'])) {
                $sort           = $filter['sort'];
                $filter['sort'] = $sort;
            }

            // 默认降序
            $sort_type = 'desc';

            if (!empty($filter['sort_type']) && $filter['sort_type'] == 'asc') {
                $sort_type           = $filter['sort_type'];
                $filter['sort_type'] = $sort_type;
            }

            $query = $query->orderBy($sort, $sort_type);
        }

        $result = $query->limit($count)->get();

        return $result;
    }

    /**
     * 通用 根据id查询对象方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     * $id          id
     */
    public function getById($id) {
        $result = null;

        if ($id) {
            $obj = $this->model->find($id);

            if ($obj) {
                $result = $obj;
            }
        }

        return $result;
    }

    /**
     * 通用 删除 对象方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     * $id          id
     */
    public function delete($id) {
        $result = $this->model->where('id', $id)->delete();

        return $result;
    }

    /**
     * 添加筛选条件方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     * $query       查询对象
     * $filter      筛选条件
     */
    protected function _append_filter(&$query, $filter = []) {
        if ($query && $filter) {
            foreach ($filter as $key => $value) {
                if (is_array($value)) {
                    // 支持like查询
                    if (count($value) >= 2 && strtolower($value[0]) == 'like') {
                        $query = $query->where($key, 'like', '%' . $value[1] . '%');
                    }
                    // 支持in
                    elseif (count($value) >= 2 && strtolower($value[0]) == 'in') {
                        $query = $query->whereIn($key, $value[1]);
                    }
                    // 支持 date
                    elseif (count($value) >= 2 && strtolower($value[0]) == 'date') {
                        $query = $query->whereDate($key, $value[1]);
                    }

                    // 支持 >, >=, <, <= 语法
                    elseif (count($value) >= 2) {
                        $query = $query->where($key, $value[0], $value[1]);
                    }
                } else if (!is_null($value)) {
                    // 支持 null
                    if (strtolower($value) == 'null') {
                        $query = $query->whereNull($key);
                    }
                    // 支持 not null
                    elseif (strtolower($value) == 'notnull') {
                        $query = $query->whereNotNull($key);
                    }
                    // 支持 =
                    else {
                        $query = $query->where($key, $value);
                    }

                }
            }
        }

        return $query;
    }

    /**
     * 添加排序方法
     * @author      Michael Liang    <liang15946@163.com>
     * @date        2017-10-17
     * $query       查询对象
     * $sorts       筛选条件 ['key1' => 'desc/asc','key2' => 'desc/asc']
     * $filter      筛选条件
     */
    protected function _append_sort(&$query, $sorts = []) {
        if (is_array($sorts) && !empty($sorts)) {
            foreach ($sorts as $key => $value) {
                // if ( $this->isModelField(strtolower($key)) ){
                $sort_type = 'desc';

                if (strtolower($value) == 'asc') {
                    $sort_type = 'asc';
                }

                $query = $query->orderBy($key, $sort_type);
                // }
            }
        } else {
            // 默认按主键排序
            $sort = 'id';
            // 默认降序
            $sort_type = 'desc';

            $query = $query->orderBy($sort, $sort_type);
        }

        return $query;
    }

}