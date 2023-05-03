<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landlord_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('landlord_property_contract_id')->constrained('landlord_property_contracts');
            $table->foreignId('landlord_id')->constrained('landlords');
            $table->tinyInteger('status')->default('0');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('rent', 10, 2)->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->tinyInteger('is_withdraw')->default('0');
            $table->tinyInteger('is_renewed')->default('0');
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
        Schema::dropIfExists('landlord_properties');
    }
}
