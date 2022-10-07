<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\hotel_roomcat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{

    public function get_valid_room_count($request){

        $reserved_rooms1 = DB::table("reservations")
                            ->selectRaw("count(rooms_number) as reserved_rooms")
                            ->where("hotel_id", "=", $request->location)
                            ->where("roomCat_id", "=", $request->room_category)
                            ->where("end_date", ">", $request->start_date)
                            ->get()[0]->reserved_rooms;

        $reserved_rooms2 = DB::table("reservations")
                            ->selectRaw("count(rooms_number) as reserved_rooms")
                            ->where("hotel_id", "=", $request->location)
                            ->where("roomCat_id", "=", $request->room_category)
                            ->where("start_date", "<", $request->end_date)
                            ->get()[0]->reserved_rooms;

        $reserved_rooms = $reserved_rooms1 + $reserved_rooms2;

        $x =   hotel_roomcat::with("category")
                            ->with("hotel")
                            ->where("roomCat_id", $request->room_category)
                            ->where("hotel_id", $request->location)
                            ->first();
                            ;

        $available_rooms = $x->total_inventory - $reserved_rooms;

        return $available_rooms;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hotel::get()->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "start_date" => 'required|date_format:Y-m-d',
            "end_date" => 'required|date_format:Y-m-d',
            "adults" => 'required|numeric|min:1',
            "children" => 'required|numeric',
            "rooms" => 'required|numeric|min:1|max:3',
            "location" => 'required|numeric',
            "room_category" => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {

            $x =   hotel_roomcat::with("category")
                                 ->with("hotel")
                                 ->where("roomCat_id", $request->room_category)
                                 ->where("hotel_id", $request->location)
                                 ->first();

        return [
                "count"=> $this->get_valid_room_count($request) ,
                "image"=> $x->category->image ,
                "price"=> $x->category->price ,
                "description"=> $x->category->description ,
                "name"=> $x->hotel->name ,
                ] ;
        }
    }


}
