<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('divice');
            $table->bigInteger('service_required')->unsigned();
            $table->bigInteger('technical')->unsigned();
            $table->json('repair_details')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('service_required')->references('id')->on('product_services');
            $table->foreign('technical')->references('id')->on('technicals');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
