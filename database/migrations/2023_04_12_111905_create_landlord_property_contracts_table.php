<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordPropertyContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landlord_property_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('landlord_id')->constrained('landlords');
            $table->string('contract_no')->unique();
            $table->string('lease_period');
            $table->string('lease_commencement');
            $table->string('lease_expiry')->nullable();
            $table->string('lease_period_arabic')->nullable();
            $table->string('monthly_rent');
            $table->string('security_deposit')->nullable();
            $table->string('cheque_no')->nullable();
            $table->integer('share_holders')->nullable();
            $table->string('rent_payment_commencement')->nullable();
            $table->tinyInteger('is_draft')->default('0');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->tinyInteger('is_published')->default('0');
            $table->tinyInteger('is_withdraw')->default('0');
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
        Schema::dropIfExists('landlord_property_contracts');
    }
}