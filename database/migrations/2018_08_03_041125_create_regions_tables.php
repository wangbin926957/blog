<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTables extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('名称');
            $table->integer('parent_id')->nullable()->comment('父id');
            $table->string('short_name')->nullable()->comment('简称');
            $table->tinyInteger('level')->nullable()->comment('分级');
            $table->string('city_code', 40)->nullable()->comment('区号');
            $table->string('zip_code', 40)->nullable()->comment('邮编');
            $table->string('merge_name')->nullable()->comment('合并名称');
            $table->string('lng')->nullable()->comment('经度');
            $table->string('lat')->nullable()->comment('纬度');
            $table->string('pinyin')->nullable()->comment('拼音');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('regions');
    }
}
