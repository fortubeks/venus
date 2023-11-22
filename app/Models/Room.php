<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['hotel_id','room_category_id','name','rate','discounted_rate','status','description','image'];
    
    public function category(){
        return $this->belongsTo(RoomCategory::class,'room_category_id');
    }
    public function reservations(){
        return $this->hasMany(RoomReservation::class);
    }
    // public function reservation(){
    //     return $this->belongsTo(RoomReservation::class);
    // }
    public function status(){
        $status = "";
        switch ($this->status) {
            case 1:
                $status = "Available For Booking";
                break;
            case 2:
                $status = "Occupied";
                break;
            case 3:
                $status = "Out of Order";
                break;
            case 1:
                $status = "Needs Cleaning";
                break;
                       
            default:
                # code...
                break;
        }
        return $status;
    }

    public function hasReservation($date){
        $reservation = $this->reservations()->whereDate('checkout_date', '>', $date)->whereDate('checkin_date','<=',$date)
        ->whereNull('checked_out_at')->first();
        // $reservation = RoomReservation::whereDate('checkout_date', '>', 'h')->whereDate('checkin_date','<=',$_date)
        // ->whereNotNull('checked_out_at');
        return $reservation;
    }
    public function isAvailable($checkin_date,$checkout_date){
        
        return true;
    }
}
