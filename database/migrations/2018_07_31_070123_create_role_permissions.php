<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissions extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('role_id')->comment('角色id');
            $table->text('permissions')->comment('角色权限');

            $table->integer('created_by')->default(0)->comment('添加人id');
            $table->integer('updated_by')->default(0)->comment('修改人id');
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
        Schema::dropIfExists('role_permissions');
    }
}
