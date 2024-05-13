<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lettings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('version')->nullable();
            $table->string('property_contract_status')->nullable();
            $table->string('target_weekly_rent')->nullable();
            $table->string('achieved_weekly_rent')->nullable();
            $table->string('floorplan')->nullable();
            $table->string('date_of_refurb')->nullable();
            $table->boolean('tv')->default(0);
            $table->boolean('archive')->default(0);
            // $table->string('cay_letting_status')->nullable();
            // $table->string('cay_contract_status_log')->nullable();
            // $table->string('cay_beds_let')->nullable();
            // $table->string('cay_beds_vacant')->nullable();
            // $table->string('cay_target_weekly_rent_pppw');
            // $table->string('cay_secured_weekly_rent_pppw')->nullable();
            // $table->string('cay_target_annual_rent');
            // $table->string('cay_secured_annual_rent')->nullable();
            // $table->string('cay_rent_difference')->nullable();
            // $table->string('cay_tenancy_start_date')->nullable();
            // $table->string('cay_tenancy_end_date')->nullable();
            // $table->string('cay_tenancy_period')->nullable();
            // $table->string('nay_letting_status')->nullable();
            // $table->string('nay_contract_status_log')->nullable();
            // $table->string('nay_beds_let')->nullable();
            // $table->string('nay_beds_vacant')->nullable();
            // $table->string('nay_target_weekly_rent_pppw')->nullable();
            // $table->string('nay_secured_weekly_rent_pppw')->nullable();
            // $table->string('nay_target_annual_rent')->nullable();
            // $table->string('nay_secured_annual_rent')->nullable();
            // $table->string('nay_rent_difference')->nullable();
            // $table->string('nay_tenancy_start_date')->nullable();
            // $table->string('nay_tenancy_end_date')->nullable();
            // $table->string('nay_tenancy_period')->nullable();
            // $table->string('date_listed_on_rightmove')->nullable();
            // $table->string('date_updated_on_rightmove')->nullable();
            // $table->string('virtual_tour')->nullable();
            // $table->string('similar_properties')->nullable();
            $table->timestamps();
        });
        Schema::table('lettings', function($table){
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
        Schema::dropIfExists('lettings');
    }
}
