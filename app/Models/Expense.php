<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'supplier_id','category_id','description','expense_date','amount',
        'expense_date','qty','rate','note','hotel_id'
    ];
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
    public function payments(){
        return $this->hasMany('App\Models\ExpensePayment');
    }
    public function category(){
        return $this->belongsTo('App\Models\ExpenseCategory','id');
    }
    public function items(){
        return $this->hasMany('App\Models\ExpenseItem');
    }
    public function paymentStatus(){
        $status = "Not Paid";
        if($this->payments()->sum('amount') >= $this->amount){
            $status = "All Paid"; 
        }
        if($this->payments()->sum('amount') < $this->amount  && $this->payments()->sum('amount') > 0){
            $status = "Part Paid"; 
        }
        return $status;
    }
}