<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;
    protected $fillable = ['hotel_id','name','description','rate','discounted_rate','image'];
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
