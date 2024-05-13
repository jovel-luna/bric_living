<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('budget_year');
            $table->string('hmo_licence_fee')->nullable();
            $table->string('hmo_licence_period')->nullable();
            $table->string('hmo_fee_per_year')->nullable();
            $table->string('maintenance_property_year')->nullable();
            $table->string('maintenance_bed_year')->nullable();
            $table->string('gas_property_year')->nullable();
            $table->string('gas_bed_year')->nullable();
            $table->string('electric_property_year')->nullable();
            $table->string('electric_bed_year')->nullable();
            $table->string('water_property_year')->nullable();
            $table->string('water_bed_year')->nullable();
            $table->string('internet_property_year')->nullable();
            $table->string('internet_bed_year')->nullable();
            $table->string('tv_licence_per_house')->nullable();
            $table->string('property_insurance_annual_cost')->nullable();
            $table->string('total_opex_budget')->nullable();
            $table->timestamps();
        });
        Schema::table('operation_budgets', function($table){
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
        Schema::dropIfExists('operation_budgets');
    }
}
