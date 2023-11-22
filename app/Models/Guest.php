<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['hotel_id','first_name','last_name','other_name','phone','address','title','email'];
    public function fullName(){
        return $this->title.' '.$this->first_name.' '.$this->last_name;
    }
}
