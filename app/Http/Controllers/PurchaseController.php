<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseStoreItem;
use App\Models\StoreItem;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Purchase $model)
    {
        return view('pages.purchases.index', ['purchases' => $model->orderBy('created_at','desc')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.purchases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate(  [
            'purchase_date' => 'required',
            'category_id' => 'required',
        ]);
        $amount = 0;
        foreach($request->amount as $_amount){
            $amount += $_amount;
        }
        //add tax (if any) to amount to get total amount
        $purchase = Purchase::create(
        ['hotel_id' => auth()->user()->hotel_id,
        'purchase_date' => $request->purchase_date,
        'amount' => $amount,
        'total_amount' => $amount,
        'status' => $request->status,
        'note' => $request->note,
        'category_id' => $request->category_id
        ]);
        foreach($request->description as $key => $description){
            if($request->description[$key] === null){
                continue;
            }
            //if purchase category doesn't have item, create item and use the id to create purchase item
            $item = StoreItem::where('purchase_category_id',$request->category_id)->where('name',$description)->first();
            if($item === null){
                $item = StoreItem::create([
                    'hotel_id' => auth()->user()->hotel_id,
                    'name' => $description,
                    'purchase_category_id' => $request->category_id,
                ]);
            }
            
            PurchaseStoreItem::create([
                'purchase_id' => $purchase->id,
                'store_item_id' => $item->id,
                'hotel_id' => auth()->user()->hotel_id,
                'qty' => $request->qty[$key],
                'received' => $request->received[$key],
                'rate' => $request->rate[$key],
                'amount' => $request->amount[$key],
                'total_amount' => $request->amount[$key],
                'unit_qty' => $request->unit_qty[$key]
            ]);

            //update store item qty with received quantity
            $item->qty += $request->qty[$key];
            $item->save();
        }
        if($request->hasFile('uploaded_file')){
            
        }
        return redirect('purchases')->with('success','Purchase added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('pages.purchases.show')->with('purchase',$purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //for update we have to minus the qty in StoreItem record using the old 
        //received qty in purchaseStoreItem
        //then create a new record and then increase the store item qty
        //then delete the purchaseStoreItem record, then 
        $request->validate(  [
            'purchase_date' => 'required',
            'category_id' => 'required',
        ]);
        $amount = 0;
        foreach($request->amount as $_amount){
            $amount += $_amount;
        }
        foreach($request->new_item_amount as $_amount_){
            $amount += $_amount_;
        }
        //add tax (if any) to amount to get total amount
        $purchase->update(
        [
        'purchase_date' => $request->purchase_date,
        'amount' => $amount,
        'total_amount' => $amount,
        'status' => $request->status,
        'note' => $request->note,
        'category_id' => $request->category_id
        ]);
        //loop the esisting purchase items
        foreach($request->description as $key => $description){
            if($request->description[$key] === null){
                continue;
            }
            $purchase_store_item = PurchaseStoreItem::find($request->purchase_store_item_id[$key]);
            $old_received = $purchase_store_item->received;
            $purchase_store_item->update([
                'qty' => $request->qty[$key],
                'received' => $request->received[$key],
                'rate' => $request->rate[$key],
                'amount' => $request->amount[$key],
                'total_amount' => $request->amount[$key],
                'unit_qty' => $request->unit_qty[$key]
            ]);
            $store_item = $purchase_store_item->storeItem;
            $store_item->qty -= $old_received;

            $store_item->qty += $request->received[$key];
            $store_item->save();
        }
        //loop the new purchase items if any
        foreach($request->new_item_description as $key => $new_item_description){
            if($request->new_item_description[$key] === null){
                continue;
            }
            
            $item = StoreItem::where('purchase_category_id',$request->category_id)->where('name',$new_item_description[$key])->first();
            if($item === null){
                $item = StoreItem::create([
                    'hotel_id' => auth()->user()->hotel_id,
                    'name' => $new_item_description[$key],
                    'purchase_category_id' => $request->category_id,
                ]);
            }

            PurchaseStoreItem::create([
                'purchase_id' => $purchase->id,
                'store_item_id' => $item->id,
                'hotel_id' => auth()->user()->hotel_id,
                'qty' => $request->new_item_qty[$key],
                'received' => $request->new_item_received[$key],
                'rate' => $request->new_item_rate[$key],
                'amount' => $request->new_item_amount[$key],
                'total_amount' => $request->new_item_amount[$key],
                'unit_qty' => $request->new_item_unit_qty[$key]
            ]);

            //update store item qty with received quantity
            $item->qty += $request->new_item_qty[$key];
            $item->save(); 
            
        }
        if($request->hasFile('uploaded_file')){
            
        }

        return redirect('purchases/'.$purchase->id)->with('success','Purchase updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //delete purchase items  
        foreach($purchase->items as $item){
            $item->delete();
        }
        //delete payments
        foreach($purchase->payments as $payment){
            $payment->delete();
        }
        //then delete the purchase
        $purchase->delete();
        return redirect('purchases')->with('success','Purchase deleted successfully');
    }

    public function filterPurchases(Request $request){
        $_purchases = Purchase::whereBetween('created_at', [$request->filter_from, $request->filter_to]);
        $purchases = $_purchases->paginate(15)->appends([
            'filter_from' => request('filter_from'),
            'filter_to' => request('filter_to'),
            ]);
        $purchases_sum = $_purchases->sum('amount');
        $purchases_count = $_purchases->count();
        return view('purchases.index')->with(compact('purchases','purchases_count','purchases_sum'));
    }
}
