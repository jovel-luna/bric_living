<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailedActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailed_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_id')->constrained('activity_logs');
            $table->string('activity_field');
            $table->string('details')->default('NA');
            $table->string('details_old')->default('NA');
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
        Schema::drop('detailed_activity_logs');
    }
}
