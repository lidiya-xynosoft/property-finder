<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintCancellationReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_cancellation_reasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_complaint_id')->constrained('property_complaints');
            $table->foreignId('cancellation_reason_id')->constrained('cancellation_reasons');
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
        Schema::dropIfExists('complaint_cancellation_reasons');
    }
}
