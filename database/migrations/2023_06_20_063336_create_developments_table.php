<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('existing_beds')->nullable();
            $table->string('existing_stories')->nullable();
            $table->string('bric_stories')->nullable();
            $table->string('bric_beds')->nullable();
            $table->string('project_start_date')->nullable();
            $table->string('projected_completion_date')->nullable();
            $table->string('over_running')->nullable();
            $table->string('development_status')->nullable();
            $table->string('pc_company')->nullable();
            $table->string('pc_name')->nullable();
            $table->string('pc_mobile')->nullable();
            $table->string('pc_email')->nullable();
            $table->string('bc_company')->nullable();
            $table->string('bc_name')->nullable();
            $table->string('bc_mobile')->nullable();
            $table->string('bc_email')->nullable();
            $table->longText('hs_development_compliance')->nullable();
            $table->string('overall_budget')->nullable();
            $table->string('actual_spend')->nullable();
            $table->timestamps();
        });
        Schema::table('developments', function($table){
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
        Schema::dropIfExists('developments');
    }
}
