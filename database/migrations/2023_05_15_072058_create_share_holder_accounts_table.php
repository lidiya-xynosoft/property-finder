<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareHolderAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_holder_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('parent_property_id')->ullable()->constrained('properties');
            $table->foreignId('ledger_id')->constrained('ledgers');
            $table->foreignId('share_holder_id')->constrained('share_holders');
            $table->foreignId('landlord_property_contract_id')->nullable()->constrained('landlord_property_contracts');
            $table->foreignId('property_agreement_id')->nullable()->constrained('property_agreements');
            $table->string('reference')->comment('0-income,1-expense');
            $table->float('reference_amount')->default(0.00);
            $table->float('ledger_amount')->default(0.00);
            $table->float('applied_percentage')->default(0.00);
            $table->float('applied_amount')->default(0.00);
            $table->float('debit')->nullable();
            $table->float('credit')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('share_holder_accounts');
    }
}
