<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;


    protected $fillable = [ "guest_id", "hotel_id","roomCat_id","start_date","end_date" , "status" , "rooms_number" ,"adults_number" , "children_number"] ;
}
