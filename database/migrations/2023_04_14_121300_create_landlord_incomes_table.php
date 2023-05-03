<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landlord_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landlord_id')->constrained('landlords');
            $table->foreignId('landlord_property_contract_id')->constrained('landlord_property_contracts');
            $table->foreignId('payment_type_id')->constrained('payment_types');
            $table->foreignId('ledger_id')->constrained('ledgers');
            $table->foreignId('property_id')->constrained('properties');
            $table->string('name');
            $table->string('reference')->nullable();
            $table->longText('description')->nullable();
            $table->float('amount', 10, 3)->default(0.00);
            $table->date('date');
            $table->date('income_date');
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('landlord_incomes');
    }
}
