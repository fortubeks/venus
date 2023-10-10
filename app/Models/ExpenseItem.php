<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_id','item_id','hotel_id','qty','rate','amount','unit_qty'
    ];
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
}
