<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{
    use HasFactory;
    protected $fillable = ['guest_id','room_id','user_id','hotel_id','rate','checkin_date','checkout_date'];

    public function room(){
        return $this->belongsTo(Room::class);
    }
    public function guest(){
        return $this->belongsTo(Guest::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function paymentStatus(){
        return "Not Paid";
    }
}
