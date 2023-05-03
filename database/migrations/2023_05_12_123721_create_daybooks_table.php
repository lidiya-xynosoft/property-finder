<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaybooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daybooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('property_agreement_id')->nullable()->constrained('property_agreements');
            $table->foreignId('landlord_property_contract_id')->nullable()->constrained('landlord_property_contracts');
            $table->foreignId('user_id')->constrained('users');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('title');
            $table->string('head');
            $table->float('debit', 10, 3)->default(0.00);
            $table->float('credit', 10, 3)->default(0.00);
            $table->float('total', 10, 3)->default(0.00);
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
        Schema::dropIfExists('daybooks');
    }
}
