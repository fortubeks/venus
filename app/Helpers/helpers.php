<?php

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseItem;
use App\Models\Item;
use App\Models\PurchaseItem;
use App\Models\StoreItem;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

if (!function_exists('title')) {
  function title($title = null)
  {
    if (!empty($title)) {
      return $title . " - " . config('flowdash.brand');
    }

    return config('flowdash.brand');
  }
}

if (!function_exists('activeClass')) {
  function activeClass($route, $activeClass = 'active')
  {
    return request()->routeIs($route) ? $activeClass : '';
  }
}

if (!function_exists('arrayToObject')) {
  function arrayToObject($d) {
    if (is_array($d)) {
      /*
      * Return array converted to object
      * Using __FUNCTION__ (Magic constant)
      * for recursive call
      */
      return (object) array_map(__FUNCTION__, $d);
    }
    else {
      // Return object
      return $d;
    }
  }
}
function getModelList($model){
  $model_list = null;

  if($model == 'countries'){
      $model_list = DB::select('select id,name from countries');
  }
  if($model == 'states'){
      $model_list = DB::select('select id,name from states');
  }
  if($model == 'expense-categories'){
    $model_list = ExpenseCategory::where('hotel_id',0)->orWhere('hotel_id',auth()->user()->hotel_id)->get();
  }
  if($model == 'suppliers'){
    $model_list = Supplier::where('hotel_id',auth()->user()->hotel_id)->get();
  }
  if($model == 'expense-items'){
    $model_list = ExpenseItem::where('hotel_id',auth()->user()->hotel_id)->get();
  }
  if($model == 'store-items'){
    $model_list = StoreItem::where('hotel_id',auth()->user()->hotel_id)->get();
  }
  return $model_list;
}

function getBanksList(){
  $banks = ['Access Bank Plc','Fidelity Bank Plc','First City Monument Bank Plc','First Bank of Nigeria Limited','Guaranty Trust Bank Plc','Union Bank of Nigeria Plc','United Bank for Africa Plc','Zenith Bank Plc','Citibank Nigeria Limited','Ecobank Nigeria Plc','Heritage Banking Company Limited','Keystone Bank Limited','Polaris Bank Limited. (Formerly Skye Bank Plc)','Stanbic IBTC Bank Plc',
  'Standard Chartered','Sterling Bank Plc','Titan Trust Bank Limited','Unity Bank Plc','Wema Bank Plc','Globus Bank Limited','SunTrust Bank Nigeria Limited','Providus Bank Limited','Jaiz Bank Plc','Taj Bank Limited','Coronation Merchant Bank','FBNQuest Merchant Bank','FSDH Merchant Bank','Rand Merchant Bank','Nova Merchant Bank'];
  return $banks;
}

function hotelId(){
  return auth()->user()->hotel->id;
}
