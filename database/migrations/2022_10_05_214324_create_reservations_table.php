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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("guest_id");
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete("cascade");

            $table->unsignedBigInteger("hotel_id");
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete("cascade");

            $table->unsignedBigInteger("roomCat_id");
            $table->foreign('roomCat_id')->references('id')->on('room_categories')->onDelete("cascade");

            $table->date("start_date");
            $table->date("end_date");



            $table->unsignedBigInteger("rooms_number");
            $table->unsignedBigInteger("adults_number");
            $table->unsignedBigInteger("children_number");


            $table->string("status");

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
        Schema::dropIfExists('reservations');
    }
};
