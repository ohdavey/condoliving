<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('relation_id');
            $table->string('relation');
            $table->string('file_path');
            $table->timestamps();
            $table->unique(['id', 'file_path']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_files');
    }
}
