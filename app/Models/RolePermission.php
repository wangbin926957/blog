<?php

namespace App\Models;

// 角色对应权限 模型
class RolePermission extends BaseModel {
    // 自动维护 created_at 和 updated_at 字段
    public $timestamps = true;

    public $fillable = [
        'role_id', 'permissions',
    ];
}