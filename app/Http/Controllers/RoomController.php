<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Room $model)
    {
        return view('pages.rooms.index', ['rooms' => $model->where('hotel_id',auth()->user()->hotel_id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.rooms.create');
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
            'room_category_id' => 'required',
            'name' => 'required',
            'rate' => 'required'
        ]);
        $request->merge(['hotel_id' => auth()->user()->hotel_id]);
        $room = Room::create($request->all());
        return redirect('rooms')->with('success','Room was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $rooms
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('pages.rooms.show')->with('room',$room);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $rooms
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $rooms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $rooms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $room->update($request->all());
        return redirect('rooms')->with('success','Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $rooms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Room $room)
    {
        $room->delete();
        return redirect('rooms')->with('success','Room deleted successfully');
    }
}
