<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_complaint_id')->constrained('property_complaints');
            $table->foreignId('handyman_id')->nullable()->constrained('handymen');
            $table->string('invoice_no')->unique();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('property_agreement_id')->constrained('property_agreements');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
