<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id','category_id','description','purchase_date','amount',
        'note','hotel_id','status','total_amount'
    ];
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
    public function category(){
        return $this->belongsTo('App\Models\ExpenseCategory','category_id');
    }
    public function items(){
        return $this->hasMany('App\Models\PurchaseStoreItem','purchase_id');
    }
    public function status(){
        $status = "";
        switch ($this->status) {
            case 1:
                $status = "Received";
                break;
            case 2:
                $status = "Partial";
                break;
            case 3:
                $status = "Ordered";
                break;
            case 4:
                $status = "Pending";
                break;
            
            default:
                # code...
                break;
        }
        return $status;
    }
}
