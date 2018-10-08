<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
    // 不自动维护 created_at 和 updated_at 字段
    public $timestamps = false;

    public $primaryKey = 'id';
}