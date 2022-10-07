<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\hotel_roomcat;
use App\Models\RoomCategory;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{


    public function total_valid_rooms_in_hotel($req)
    {
        $x = hotel_roomcat::where("roomCat_id", $req->room_category)
            ->where("hotel_id", $req->location)
            ->first();

        $y =  $x->total_inventory - $x->total_reserved;

        if ($req->rooms <= $y) {
            return true;
        } else {
            return false;
        }
    }

    public function is_request_room_number_suitable($req)
    {
        $room_capacity = RoomCategory::find($req->room_category)->room_capacity;

        $room_in_req = $req->rooms;
        $adults_in_req = $req->adults;
        $room_should_be = $adults_in_req / $room_capacity;


        if ($room_should_be <= $room_in_req) {
            return  true;
        } else {
            return  false;
        }
    }

    public function date_validation($req)
    {
        $reserved_rooms1 = DB::table("reservations")
            ->selectRaw("count(rooms_number) as reserved_rooms")
            ->where("hotel_id", "=", $req->location)
            ->where("roomCat_id", "=", $req->room_category)
            ->where("end_date", ">", $req->start_date)
            ->get()[0]->reserved_rooms;
        $reserved_rooms2 = DB::table("reservations")
            ->selectRaw("count(rooms_number) as reserved_rooms")
            ->where("hotel_id", "=", $req->location)
            ->where("roomCat_id", "=", $req->room_category)
            ->where("start_date", "<", $req->end_date)
            ->get()[0]->reserved_rooms;

        $reserved_rooms = $reserved_rooms1 + $reserved_rooms2;

        $rooms_in_hotel = hotel_roomcat::where("roomCat_id", $req->room_category)
            ->where("hotel_id", $req->location)
            ->first()->total_inventory;

        $available_rooms = $rooms_in_hotel - $reserved_rooms;
        if ($available_rooms >= $req->rooms) {
            return true;
        } else {
            return false;
        }
    }

    public function update_guest($req)
    {
        Guest::where("id",$req->user_id )
             ->where("phone",$req->phone)
             ->update(["discount"=>true]);
    }

    public function check_user($req){
        $user =count(Guest::where("id",$req->user_id )
                          ->where("phone",$req->phone)
                          ->get());
        if($user){
            return true;
        }else{
            return false;
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "start_date" => 'required|date_format:Y-m-d',
            "end_date" => 'required|date_format:Y-m-d',
            "adults" => 'required|numeric|min:1',
            "children" => 'required|numeric',
            "rooms" => 'required|numeric|min:1|max:3',
            "location" => 'required|numeric',
            "room_category" => 'required|numeric',
            "user_id" => 'required|numeric',
            "phone" => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $check1 = $this->total_valid_rooms_in_hotel($request);
            $check2 = $this->is_request_room_number_suitable($request);
            $check3 = $this->date_validation($request);
            $check4 = $this->check_user($request);

            if ($check1 && $check2 && $check3 && $check4) {

                Reservation::create([
                    "guest_id" => $request->user_id,
                    "hotel_id" => $request->location,
                    "roomCat_id" => $request->room_category,
                    "start_date" => $request->start_date,
                    "end_date" => $request->end_date,
                    "rooms_number" => $request->rooms,
                    "adults_number" => $request->adults,
                    "children_number" => $request->children,
                    "status" => "booked"
                ]);

                $this->update_guest($request);

                return ["validation" => "Thank YOU ,, waiting for arrival ;)"];
            } else {
                return [
                    "check1" => $check1,
                    "check2" => $check2,
                    "check3" => $check3,
                    "check3" => $check3,
                ];
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
