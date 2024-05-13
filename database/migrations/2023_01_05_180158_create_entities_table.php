<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_registration_number');
            $table->string('registered_address');
            $table->string('entity_date_created');
            $table->string('statement_due_date')->nullable();
            $table->string('financial_year_start_date');
            $table->string('financial_year_end_date');
            // $table->string('no_of_properties')->nullable();
            // $table->string('no_of_beds')->nullable();
            // $table->string('pipeline')->nullable();
            // $table->string('current_rent_role')->nullable();
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
        Schema::dropIfExists('entities');
    }
}
