<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotel_roomcat extends Model
{
    use HasFactory;

    protected $table="hotel_roomcat";

    protected $fillable=["total_reserved"];


    public function category()
    {
        return $this->belongsTo(RoomCategory::class ,"roomCat_id","id");
    }
    public function hotel()
    {
        return $this->belongsTo(hotel::class ,"hotel_id","id");
    }

}
