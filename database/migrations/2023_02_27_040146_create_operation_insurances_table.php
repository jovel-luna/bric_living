<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acquisition_id');
            $table->string('insurer')->nullable();
            $table->string('insurance_account_no')->nullable();
            $table->string('insurance_value');
            $table->string('insurance_annual_cost');
            $table->string('insurance_renewal_date');
            $table->timestamps();
        });
        Schema::table('operation_insurances', function($table){
            $table->foreign('acquisition_id')->references('id')->on('acquisitions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_insurances');
    }
}
