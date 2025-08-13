<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
class DashboardController extends Controller
{
    //function for dashboard controller
    public function dashboard_driver(){
        return view('Driver.index');
    }
    //function for view all assigned bookings
    public function assign_bookings()
    {
        $driverId = Auth::id(); // logged in driver ID

        $bookings = Booking::where('driver_id', $driverId)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('driver.assign-bookings', compact('bookings'));
    }
}
