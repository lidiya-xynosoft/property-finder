<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandymanComplaintStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handyman_complaint_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('handyman_id')->nullable()->constrained('handymens');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('property_complaint_id')->nullable()->constrained('property_complaints');
            $table->foreignId('service_list_id')->nullable()->constrained('service_lists');
            $table->integer('handyman_status')->nullable()->comment('1-new order', '2-handyman assigned', '3-complaint accepted', '4-complete');
            $table->integer('is_handyman_assigned')->nullable()->default(0);
            $table->dateTime('work_start_time')->nullable();
            $table->dateTime('work_end_time')->nullable();
            $table->string('elapsed_time')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('handyman_complaint_statuses');
    }
}