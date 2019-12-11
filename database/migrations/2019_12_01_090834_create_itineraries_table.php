<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('enabled')->default(true);
            $table->tinyInteger('index')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();

            $table->float('price')->nullable();
            $table->text('description_short')->nullable();
            $table->text('description_long')->nullable();
            $table->longText('map_url')->nullable();
            $table->string('image_main')->nullable();
            $table->string('image_map')->nullable();
            $table->string('image_background')->nullable();
            $table->text('gallery')->nullable();
            $table->text('months')->nullable();
            $table->text('city')->nullable();
            $table->text('highlights')->nullable();
            $table->text('transport')->nullable();
            $table->string('travel_styles')->nullable();
            $table->string('sights')->nullable();
            $table->tinyInteger('minDuration')->nullable();
            $table->tinyInteger('maxDuration')->nullable();
            $table->text('scores')->nullable();
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
        Schema::dropIfExists('itineraries');
    }
}
