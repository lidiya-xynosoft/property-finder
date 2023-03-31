<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_complaints', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_number')->unique();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('property_agreement_id')->constrained('property_agreements');
            $table->foreignId('service_list_id')->constrained('service_lists');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('handyman_id')->constrained('handymens');
            $table->boolean('is_handyman_assigned')->default('0');
            $table->longText('complaint')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0-new,1-approved,2-rejected,3-assigned,4-resolved');
            $table->dateTime('approved_time')->nullable();
            $table->dateTime('rejected_time')->nullable();
            $table->dateTime('assigned_time')->nullable();
            $table->dateTime('resolved_time')->nullable();
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
        Schema::dropIfExists('property_complaints');
    }
}
