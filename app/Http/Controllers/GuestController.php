<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guest\GuestStoreRequest;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestStoreRequest $request)
    {   
        $request->merge(['hotel_id' => auth()->user()->hotel_id,]);
        $guest = Guest::create($request->all());

        return redirect('/')->with('success','Reservation added successfully');
    }
}
