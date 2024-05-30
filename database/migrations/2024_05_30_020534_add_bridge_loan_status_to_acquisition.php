<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBridgeLoanStatusToAcquisition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acquisitions', function (Blueprint $table) {
            $table->string('bridge_loan_status')->nullable();
            $table->string('equity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acquisitions', function (Blueprint $table) {
            $table->dropColumn(['bridge_loan_status', 'equity']);
        });
    }
}
