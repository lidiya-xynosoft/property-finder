<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandloardRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landloard_rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('landloard_id')->constrained('landloards');
            $table->foreignId('landloard_property_contract_id')->constrained('landloard_property_contracts');
            $table->foreignId('payment_type_id')->constrained('payment_types');
            $table->foreignId('ledger_id')->nullable()->constrained('ledgers');
            $table->string('month')->nullable();
            $table->string('rental_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->time('payment_time')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->float('rent_amount', 10, 3)->default(0.00);
            $table->tinyInteger('payment_status')->default('0')->comment('0-not paid,1-paid,2-pending');
            $table->tinyInteger('status')->default('1')->comment('0-not active,1-active');
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
        Schema::dropIfExists('landloard_rents');
    }
}