<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAgreementDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('property_agreement_documents', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('property_id')->constrained('properties');
        //     $table->foreignId('document_type_id')->constrained('document_types');
        //     $table->foreignId('property_agreement_id')->constrained('property_agreements');
        //     $table->tinyInteger('status')->default(1);
        //     $table->string('file');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_documents');
    }
}
