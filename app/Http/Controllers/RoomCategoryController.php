<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoomCategory $model)
    {
        return view('pages.room-categories.index', ['room_categories' => $model->where('hotel_id',auth()->user()->hotel_id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.room-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required',
        ]);
        $request->merge(['hotel_id' => auth()->user()->hotel_id]);
        $category = RoomCategory::create($request->all());
        return redirect('room-categories')->with('success','RoomCategory was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomCategory  $rooms
     * @return \Illuminate\Http\Response
     */
    public function show(RoomCategory $room_category)
    {
        return view('pages.room-categories.show')->with('room_category',$room_category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomCategory  $rooms
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomCategory $rooms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomCategory  $rooms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomCategory $room_category)
    {
        $room_category->update($request->all());
        return redirect('room-categories')->with('success','RoomCategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomCategory  $rooms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RoomCategory $room_category)
    {
        $room_category->delete();
        return redirect('room-categories')->with('success','RoomCategory deleted successfully');
    }
}
