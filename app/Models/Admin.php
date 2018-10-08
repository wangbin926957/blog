<?php
namespace App\Models;

use App\Services\RoleService;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends BaseModel {
    // 软删除
    use SoftDeletes;
    // 自动维护 created_at 和 updated_at 字段
    public $timestamps = true;

    // 允许添加的字段
    public $fillable = [
        'id',
        'account',
        'phone',
        'email',
        'salt',
        'pwd',
        'name',
        'group_id',
        'role_id',
        'gender',
        'status',
        'disabled',
        'add_by',
        'edit_by',
    ];

    /**
     * 在数组中隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['pwd', 'salt', 'deleted_at'];

    /**
     * 获取用户角色名称
     *
     * @param  string  $value
     * @return string
     */
    public function getRoleNameAttribute() {
        $role_name = '';
        $role_id   = $this->role_id;
        $roles     = RoleService::getAllRoles();

        if (isset($roles[$role_id]['role_name'])) {
            $role_name = $roles[$role_id]['role_name'];
        }

        return $role_name;
    }

    // 判断用户权限
    public function hasPermission($permission) {
        $result           = false;
        $role_permissions = RoleService::getPermissionsBy($this->role_id);

        if (in_array($permission, $role_permissions)) {
            $result = true;
        }

        return $result;
    }
}