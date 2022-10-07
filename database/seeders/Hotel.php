<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Hotel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->insert([
            'location' => "cairo",
            "lat"=> 30.0561	,
            "lng"=> 31.2394,
        ]);
        DB::table('hotels')->insert([
            'location' => "Giza",
            "lat"=> 29.9870	,
            "lng"=> 31.2118,
        ]);
        DB::table('hotels')->insert([
            'location' => "Damietta",
            "lat"=> 31.4167	,
            "lng"=> 31.8214,
        ]);
        DB::table('hotels')->insert([
            'location' => "Alexandria",
            "lat"=> 31.2000	,
            "lng"=> 29.9167,
        ]);
        DB::table('hotels')->insert([
            'location' => "Port Said",
            "lat"=> 31.2500	,
            "lng"=> 32.2833,
        ]);
        DB::table('hotels')->insert([
            'location' => "Luxor",
            "lat"=> 25.6969	,
            "lng"=> 32.6422,
        ]);
    }
}
