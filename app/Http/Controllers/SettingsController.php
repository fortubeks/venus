<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\HotelInfoStoreRequest;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function goToPage($page){
        return view('pages.settings.'.$page);
    }
    public function updateHotelInfo(HotelInfoStoreRequest $request){
        auth()->user()->hotel->update($request->all());
        return redirect('settings/hotel-information')->with('success', 'Updated successfully');
    }
}
