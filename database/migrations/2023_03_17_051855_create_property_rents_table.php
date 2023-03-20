<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('property_agreement_id')->constrained('property_agreements');
            $table->foreignId('payment_type_id')->constrained('payment_types');
            $table->string('month')->nullable();
            $table->string('rental_date')->nullable();
            $table->payment_date('date')->nullable();
            $table->payment_time('time')->nullable();
            $table->float('rent_amount', 10, 3)->default(0.00);
            $table->tinyInteger('payment_status')->default('0')->comment('0-not paid,1-paid,2-pending');
            $table->tinyInteger('status')->default('1')->comment('0-not active,1-active');
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
        Schema::dropIfExists('property_rents');
    }
}
