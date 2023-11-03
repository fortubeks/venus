<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
    use HasFactory;
    protected $fillable = ['hotel_id','name','purchase_category_id'];
    
    public function category(){
        $category = "";
        switch ($this->purchase_category_id) {
            case 1:
                $category = "Food";
                break;
            case 2:
                $category = "Drink";
                break;
            case 3:
                $category = "Housekeeping";
                break;
            case 4:
                $category = "Maintenance";
                break;
            case 5:
                $category = "Staff";
                break;
            case 6:
                $category = "Admin/Stationeries";
                break;
            case 4:
                $category = "Others";
                break;
            
            default:
                # code...
                break;
        }
        return $category;
    }
}
