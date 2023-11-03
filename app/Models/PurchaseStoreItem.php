<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseStoreItem extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id','store_item_id','hotel_id','qty',
    'rate','amount','unit_qty','received','discount','tax_rate','tax_amount','total_amount'];
    public function storeItem(){
        return $this->belongsTo(StoreItem::class,'store_item_id');
    }
}
