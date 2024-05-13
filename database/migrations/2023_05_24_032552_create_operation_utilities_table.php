<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationUtilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('operation_utilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('gas_provider')->nullable();
            $table->string('gas_contract_start_date')->nullable();
            $table->string('gas_contract_end_date')->nullable();
            $table->string('gas_account_number')->nullable();
            $table->string('electric_provider')->nullable();
            $table->string('electric_contract_start_date')->nullable();
            $table->string('electric_contract_end_date')->nullable();
            $table->string('electric_account_number')->nullable();
            $table->string('water_provider')->nullable();
            $table->string('water_account_number')->nullable();
            $table->string('tv_licence')->nullable();
            $table->string('tv_licence_contract_start_date')->nullable();
            $table->string('tv_licence_contract_end_date')->nullable();
            $table->string('broadband_provider')->nullable();
            $table->string('broadband_account_number')->nullable();
            $table->string('insurance_in_place')->nullable();
            $table->string('insurance_provider')->nullable();
            $table->string('insurance_annual_cost')->nullable();
            $table->string('insurance_start_date')->nullable();
            $table->string('insurance_end_date')->nullable();
            $table->string('insurance_policy_no')->nullable();
            $table->string('insurance_account_no')->nullable();
            $table->string('insurance_value')->nullable();
            $table->string('insurance_renewal_date')->nullable();
            $table->timestamps();
        });

        Schema::table('operation_utilities', function($table){
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_utilities');
    }
}
