<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('purpose_id')->constrained('purposes');
            $table->foreignId('type_id')->constrained('types');
            $table->foreignId('city_id')->constrained('cities');
            $table->string('product_code')->nullable()->default('0');
            $table->string('slug')->unique();
            $table->double('price', 8, 2);
            $table->boolean('featured')->default(false);
            $table->string('image')->nullable();
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->string('city');
            $table->string('type');
            $table->string('purpose');
            $table->string('city_slug');
            $table->string('garage');
            $table->string('built_year');
            $table->string('address');
            $table->integer('area');
            $table->integer('agent_id');
            $table->text('description');
            $table->string('video')->nullable();
            $table->string('floor_plan')->nullable();
            $table->string('location_latitude');
            $table->string('location_longitude');
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
        Schema::dropIfExists('properties');
    }
}