<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_complaint_id')->constrained('property_complaints');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('property_agreement_id')->constrained('property_agreements');
            $table->string('message');
            $table->string('title');
            $table->date('date')->nullable;
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
        Schema::dropIfExists('complaint_histories');
    }
}
