<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id','name','expense_category_id'
    ];
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
}
