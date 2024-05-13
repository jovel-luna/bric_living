<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('property_phase');
            // $table->string('entity');
            $table->string('city');
            $table->string('area');
            $table->string('house_no_or_name');
            $table->string('street');
            $table->string('postcode');
            $table->string('no_bric_beds')->nullable();
            $table->string('no_bric_bathrooms')->nullable();
            $table->string('purchase_date');
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
