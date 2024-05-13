<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcquisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->string('acquisition_status');
            $table->string('single_asset_portfolio');
            $table->string('portfolio')->nullable();
            $table->string('existing_bedroom_no');
            $table->string('asking_price');
            $table->string('offer_price')->nullable();
            $table->string('agreed_purchase_price')->nullable();
            $table->string('difference')->nullable();
            $table->string('stamp_duty')->nullable();
            $table->string('acquisition_cost')->nullable();
            $table->string('agent');
            $table->string('agent_fee_percentage')->nullable();
            $table->string('agent_fee')->nullable();
            $table->string('bridge_loan')->nullable();
            $table->string('estimated_period');
            $table->string('loan_percentage')->nullable();
            $table->string('estimated_interest')->nullable();
            $table->string('estimated_tpc')->nullable();
            $table->string('offer_date')->nullable();
            $table->string('target_completion_date')->nullable();
            $table->string('completion_date')->nullable();
            $table->string('col_status')->nullable();
            $table->longText('col_status_log')->nullable();
            $table->string('financing_status')->nullable();
            $table->string('bric_purchase_yield_percentage')->nullable();
            $table->string('tpc_bedspace')->nullable();
            $table->string('purchase_price_bedspace')->nullable();
            $table->string('bric_y1_proposed_rent_pppw')->nullable();
            $table->string('tenancy_length_weeks')->nullable();
            $table->string('tennure');
            $table->string('ground_rent')->nullable();
            $table->string('ground_rent_due')->nullable();
            $table->timestamps();
        });
        Schema::table('acquisitions', function($table){
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
        Schema::dropIfExists('acquisitions');
    }
}
