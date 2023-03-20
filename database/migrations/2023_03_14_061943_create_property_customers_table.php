<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('property_agreement_id')->constrained('property_agreements');
            $table->foreignId('customer_id')->constrained('customers');
            $table->tinyInteger('status')->default('0');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('rent_date')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->tinyInteger('is_withdraw')->default('0');
            $table->tinyInteger('is_renewed')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_customers');
    }
}