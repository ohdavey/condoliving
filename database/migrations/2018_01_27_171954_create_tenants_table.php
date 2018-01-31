<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ssn', 20);
            $table->unsignedInteger('property_id');
            $table->string('first_name', 50);
            $table->string('last_name', 70);
            $table->string('email', 70);
            $table->string('phone', 22);
            $table->date('dob');
            $table->float('salary', 8, 2);
            $table->timestamps();
            $table->unique(['ssn', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
