<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tenant_id');
            $table->unsignedInteger('property_id');
            $table->float('deposit', 8, 2);
            $table->float('monthly_rate', 8, 2);
            $table->decimal('late_fee', 5, 2);
            $table->float('maintenance_fee', 8, 2);
            $table->string('amenities', 255);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('status');
            $table->text('notes');
            $table->timestamps();
            $table->unique(['tenant_id', 'property_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leases');
    }
}
