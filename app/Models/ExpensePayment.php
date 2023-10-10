<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpensePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'expense_id','amount','mode_of_payment','hotel_id','note','date_of_payment',
    ];
}
