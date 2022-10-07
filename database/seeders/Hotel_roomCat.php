<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class hotel_roomCat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $n = count(DB::table("hotels")->get());
        $m = count(DB::table("room_categories")->get());

        for ($x = 1; $x <= $n; $x++) {
            for ($y = 1; $y <= $m; $y++) {
            DB::table('hotel_roomcat')->insert([
                'roomCat_id' => $y,
                "hotel_id"=> $x,
                "total_inventory"=> 3,
                "total_reserved"=> 0,
            ]);
          }
        }
    }
}
