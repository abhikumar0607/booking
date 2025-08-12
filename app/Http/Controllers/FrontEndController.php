<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    //    
    public function home() {
        // Logic for the home page can be added here
        return view('home-page');
    }
}
