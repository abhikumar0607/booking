<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Booking;
class DashboardController extends Controller
{
    //function for dashboard controller
    public function index(){
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        $drivers = User::where('user_type', 'driver')->get();
        return view('Admin.index', compact('bookings', 'drivers'));
    }
}
