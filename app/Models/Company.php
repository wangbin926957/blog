<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends BaseModel {
    // 软删除
    use SoftDeletes;
    // 自动维护 created_at 和 updated_at 字段
    public $timestamps = true;

    // 允许添加的字段
    public $fillable = [
        'name',
        'province_id',
        'city_id',
        'area_id',
        'backup',
        'status',
        'disabled',
        'created_by',
        'updated_by',
    ];
}