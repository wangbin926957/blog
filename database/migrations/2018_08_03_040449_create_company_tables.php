<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTables extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('公司名称');
            $table->integer('province_id')->nullable()->comment('省');
            $table->integer('city_id')->nullable()->comment('市');
            $table->integer('area_id')->nullable()->comment('区');
            $table->text('backup')->nullable()->comment('备注');
            $table->tinyInteger('status')->default(0)->comment('状态');
            $table->tinyInteger('disabled')->default(0)->comment('禁用');

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
        Schema::dropIfExists('companies');
    }
}
