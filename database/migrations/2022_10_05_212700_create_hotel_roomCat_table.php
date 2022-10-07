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
        Schema::create('hotel_roomCat', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("hotel_id");
            $table->    foreign('hotel_id')->references('id')->on('hotels')->onDelete("cascade");

            $table->unsignedBigInteger("roomCat_id");
            $table->foreign('roomCat_id')->references('id')->on('room_categories')->onDelete("cascade");

            $table->unsignedBigInteger("total_inventory");
            $table->unsignedBigInteger("total_reserved");

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
        Schema::dropIfExists('room_categories');
    }
};
