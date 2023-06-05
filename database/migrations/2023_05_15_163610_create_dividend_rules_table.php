<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordDividendRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dividend_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('landlord_property_contract_id')->nullable()->constrained('landlord_property_contracts');
            $table->foreignId('property_agreement_id')->nullable()->constrained('property_agreements');
            $table->integer('no_of_share_holders');
            $table->foreignId('share_holder_id')->constrained('share_holders');
            $table->float('percentage')->default(0.00);
            $table->tinyInteger('mode_of_calculation')->comment('0-daily,1-monthly');
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
        Schema::dropIfExists('landlord_dividend_rules');
    }
}
