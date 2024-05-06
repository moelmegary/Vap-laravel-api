<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_orders', function (Blueprint $table) {
            $table->bigIncrements('hotelOrder_id');
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('hotel_id')->on('hotels')->onDelete('cascade');
            $table->string('descriptionOrder');
            $table->date('bookingDate');	
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('hotel_orders');
    }
};
