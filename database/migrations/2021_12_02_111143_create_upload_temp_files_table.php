<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadTempFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_temp_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('create_at')->comment('上传时间');
            $table->string('domain')->comment('图片所在域名');
            $table->string('path')->comment('图片相对路径');
            $table->string('url')->comment('图片url');
            $table->string('origin_name')->comment('原始名称');
            $table->unsignedTinyInteger('is_moved')->default(0)->comment('是否已移动');
            $table->string('move_table')->nullable()->comment('移动目的表');
            $table->string('move_table_id')->nullable()->comment('移动目的表ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_temp_files');
    }
}
