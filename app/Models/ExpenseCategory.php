<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name','parent_id','hotel_id'
    ];
    public function expenses()
    {
        return $this->hasMany('App\Models\Expense');
    }
    public function subCategories()
    {
        return $this->hasMany('App\Models\ExpenseCategory');
    }
}