<?php

namespace App\Http\Controllers;

use App\Models\StoreItem;
use Illuminate\Http\Request;

class StoreItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StoreItem $model)
    {
        return view('pages.store-items.index', ['store_items' => $model->where('hotel_id',auth()->user()->hotel_id)->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.store-items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store_items = StoreItem::create([ 
            'name' => $request->name,
            'purchase_category_id' => $request->category,
            'hotel_id' => auth()->user()->hotel_id,
        ]);
        return redirect('store-items')->with('success','Store Item was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreItem  $store_items
     * @return \Illuminate\Http\Response
     */
    public function show(StoreItem $store_item)
    {
        return view('pages.store-items.show')->with('store_item',$store_item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreItem  $store_items
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreItem $store_items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreItem  $store_items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreItem $store_item)
    {
        $store_item->update($request->all());
        return redirect('store-items')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreItem  $store_items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, StoreItem $store_item)
    {
        $store_item->delete();
        return redirect('store-items')->with('success','Item deleted successfully');
    }
}
