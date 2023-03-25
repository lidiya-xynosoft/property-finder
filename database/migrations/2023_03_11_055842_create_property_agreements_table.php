<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('agreement_id')->unique();
            $table->string('tenant_name');
            $table->string('tenant_name_arabic');
            $table->string('tenant_no');
            $table->string('po_box');
            $table->string('phone');
            $table->string('email');
            $table->string('unit_no');
            $table->string('unit_no_arabic')->nullable();
            $table->string('building_name_english');
            $table->string('building_name_arabic');
            $table->longText('utilities');
            $table->longText('unit_type_english');
            $table->longText('unit_type_arabic');
            $table->string('water_no')->nullable();
            $table->string('electricity_no');
            $table->string('building_no')->nullable();
            $table->string('zone')->nullable();
            $table->string('street')->nullable();
            $table->longText('location_english');
            $table->longText('location_arabic');
            $table->string('lease_period');
            $table->string('lease_commencement');
            $table->string('lease_expiry')->nullable();
            $table->string('lease_period_arabic')->nullable();
            $table->string('lease_commencement_arabic')->nullable();
            $table->string('lease_expiry_arabic')->nullable();
            $table->string('monthly_rent');
            $table->string('monthly_rent_arabic');
            $table->longText('utilities_arabic');
            $table->string('payment_mode_arabic')->nullable();
            $table->string('payment_mode')->nullable();
            $table->integer('no_of_check')->nullable();
            $table->string('security_deposit_arabic');
            $table->string('security_deposit')->nullable();
            $table->string('rent_payment_commencement')->nullable();
            $table->string('rent_payment_commencement_arabic');
            $table->string('rent_free')->nullable();
            $table->tinyInteger('is_draft')->default('0');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->tinyInteger('is_published')->default('0');
            $table->tinyInteger('is_signed')->default('0');
            $table->tinyInteger('is_withdraw')->default('0');
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
        Schema::dropIfExists('property_agreements');
    }
}