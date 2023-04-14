<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandloardExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landloard_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landloard_id')->constrained('landloards');
            $table->foreignId('landloard_property_contract_id')->constrained('landloard_property_contracts');
            $table->foreignId('payment_type_id')->constrained('payment_types');
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('ledger_id')->constrained('ledgers');
            $table->string('name');
            $table->string('reference')->nullable();
            $table->longText('description')->nullable();
            $table->float('amount', 10, 3)->default(0.00);
            $table->date('date');
            $table->date('expense_date');
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
        Schema::dropIfExists('landloard_expenses');
    }
}