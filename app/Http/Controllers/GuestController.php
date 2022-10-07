<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GuestController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all() ,[
            $request->name => "required|max:30",
            $request->phone => "required|max:14|unique:phone",
        ]);

        $exits = count(Guest::where("phone", $request->phone)->get());

        if($validator && $exits == 0  ){
            Guest::create([
                            "name"=>$request->name ,
                            "phone"=>$request->phone ,
            ]);
        }

        $user = Guest::where("phone", $request->phone)->first() ;
        return $user;

    }
}
