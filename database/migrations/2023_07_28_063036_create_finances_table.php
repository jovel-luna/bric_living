<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('cm_mortgage_status')->nullable();
            $table->string('cm_provider')->nullable();
            $table->string('cm_account_no')->nullable();
            $table->string('cm_start_date')->nullable();
            $table->string('cm_expiration_date')->nullable();
            $table->string('cm_loan_period')->nullable();
            $table->string('cm_current_valuation')->nullable();
            $table->string('cm_loan_amount')->nullable();
            $table->string('cm_loan')->nullable();
            $table->string('cm_interest_rate')->nullable();
            $table->string('cm_monthly_repayments')->nullable();
            $table->string('cm_monthly_payment_date')->nullable();
            $table->string('m_provider')->nullable();
            $table->string('m_account_no')->nullable();
            $table->string('m_start_date')->nullable();
            $table->string('m_expiration_date')->nullable();
            $table->string('m_loan_period')->nullable();
            $table->string('m_estimated_loan')->nullable();
            $table->string('m_agreed_loan')->nullable();
            $table->string('m_estimated_equity_release')->nullable();
            $table->string('m_equity_release')->nullable();
            $table->string('m_loan')->nullable();
            $table->string('m_start_fixed_rate_period')->nullable();
            $table->string('m_end_fixed_rate_period')->nullable();
            $table->string('m_monthly_repayment')->nullable();
            $table->string('m_monthly_payment_date')->nullable();
            $table->timestamps();
        });
        Schema::table('finances', function($table){
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
        Schema::dropIfExists('finances');
    }
}
