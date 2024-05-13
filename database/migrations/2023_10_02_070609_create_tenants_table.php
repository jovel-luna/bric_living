<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('name')->nullable();
            $table->string('source')->nullable();
            $table->string('tenant_contract_status')->nullable();
            $table->boolean('id_certified')->default(0);
            $table->boolean('poa')->default(0);
            $table->string('deposits_paid')->default(0);
            $table->string('document_outstanding')->default(0);
            $table->timestamps();
        });
        Schema::table('tenants', function($table){
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
        Schema::dropIfExists('tenants');
    }
}
