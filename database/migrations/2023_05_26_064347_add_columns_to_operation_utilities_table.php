<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOperationUtilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operation_utilities', function (Blueprint $table) {
            $table->longText('operation_log')->after('insurance_renewal_date')->nullable();
            $table->string('council_account_no')->after('insurance_renewal_date')->nullable();
            $table->string('exemption_date')->after('insurance_renewal_date')->nullable();
            $table->string('exempt')->after('insurance_renewal_date')->nullable();
            $table->string('bills_received')->after('insurance_renewal_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operation_utilities', function (Blueprint $table) {
            $table->dropColumn('operation_log');
            $table->dropColumn('council_account_no');
            $table->dropColumn('exemption_date');
            $table->dropColumn('exempt');
            $table->dropColumn('bills_received');
        });
    }
}
