<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //check for setup
        // if(auth()->user()->user_type == "super_admin"){
        //     // if (auth()->user()->hotel->name == 'Venus') {  
        //     //     return view('pages.settings.setup.business-info')->with('setting',auth()->user()->app_settings);
        //     //   }
            
        //     return view('home');
        // }
        // if(auth()->user()->user_type == "accounts"){
        //     // if (auth()->user()->hotel->name == 'Venus') {  
        //     //     return view('pages.settings.setup.business-info')->with('setting',auth()->user()->app_settings);
        //     //   }
            
        //     return view('accounts-dashboard');
        // }
        return view(auth()->user()->user_type.'-dashboard');
    }
}
