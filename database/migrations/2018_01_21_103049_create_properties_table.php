<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->integer('community_id');
            $table->string('address');
            $table->string('unit');
            $table->integer('beds');
            $table->integer('baths');
            $table->integer('sqft');
            $table->integer('year_built');
            $table->integer('parking');
            $table->float('price', 8, 2);
            $table->text('body');
            $table->string('type');
            $table->integer('status');
            $table->unique(['address']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
