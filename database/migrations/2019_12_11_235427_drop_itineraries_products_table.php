<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropItinerariesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('itineraries_products');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('itineraries_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('itinerary_id');
            $table->integer('product_id');
            $table->timestamps();
        });
    }
}
