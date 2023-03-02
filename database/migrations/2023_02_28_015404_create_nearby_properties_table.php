<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNearbyPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nearby_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nearby_category_id')->constrained('nearby_categories');
            $table->foreignId('property_id')->constrained('properties');
            $table->string('title');
            $table->string('distance');
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
        Schema::dropIfExists('nearby_properties');
    }
}
