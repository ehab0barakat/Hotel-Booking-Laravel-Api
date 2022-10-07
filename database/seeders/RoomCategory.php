<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_categories')->insert([
            "name" =>"single",
            "room_capacity"=>1,
            "image"=>"http://i-exc.ccm2.net/iex/1280/1627672278/770057.jpg",
            "description" => "this from database and i sware this room is awesome ;) its a single room  ",
            "price"=>50
        ]);
        DB::table('room_categories')->insert([
            "name" =>"double",
            "room_capacity"=>2,
            "image"=>"https://cnn-arabic-images.cnn.io/cloudinary/image/upload/w_780,h_439,c_fill,q_auto/cnnarabic/2018/05/14/images/55774.jpg",
            "description" => "this from database and i sware this room is awesome ;) its a double room  ",
            "price"=>100
        ]);
        DB::table('room_categories')->insert([
            "name" =>"suite",
            "room_capacity"=>4,
            "image"=>"https://exp.cdn-hotels.com/hotels/33000000/32420000/32419000/32418903/3f2ae643_z.jpg?impolicy=fcrop&w=500&h=333&q=medium",
            "description" => "this from database and i sware this room is awesome ;) its a suite room  ",
            "price"=>300
        ]);
    }
}
