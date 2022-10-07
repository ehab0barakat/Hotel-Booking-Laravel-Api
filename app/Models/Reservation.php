<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;


    // protected $fillable = [ "guest_id", "hotel_id","roomCat_id","start_date","end_date" , "status" , "rooms_number" ,"adults_number" , "children_number"] ;
    protected $guarded = [] ;


    public function guest()
    {
        return $this->belongsTo(Guest::class,"guest_id" , "id");
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class,"hotel_id" , "id");
    }

    public function roomCat()
    {
        return $this->belongsTo(RoomCategory::class,"roomCat_id" , "id");
    }



}
