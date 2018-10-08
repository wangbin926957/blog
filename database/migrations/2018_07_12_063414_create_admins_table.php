<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 50)->default('')->comment('账号');
            $table->string('phone', 20)->nullable()->comment('手机号');
            $table->string('email', 50)->nullable()->comment('邮箱');
            $table->string('salt', 10)->comment('密码加密干扰串');
            $table->string('pwd')->comment('密码');
            $table->string('name')->nullable()->comment('姓名');
            $table->integer('group_id')->default(0)->comment('角色组id');
            $table->integer('role_id')->default(0)->comment('角色id');
            $table->tinyInteger('gender')->default(0)->comment('性别 0:未设置 1:男 2:女');
            $table->tinyInteger('status')->default(0)->comment('用户状态');
            $table->tinyInteger('disabled')->default(0)->comment('是否禁用 0:可用 1:禁用');

            $table->integer('created_by')->nullable()->comment('添加人id');
            $table->integer('updated_by')->nullable()->comment('修改人id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('admins');
    }
}
