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
        $driverId = Auth::id();
        $bookings = Booking::where('driver_id', $driverId)->orderBy('created_at', 'desc')->get();
        return view('Driver.index', compact('bookings'));
    }
    //function for view all assigned bookings
    public function assign_bookings()
    {
        $driverId = Auth::id();
        $bookings = Booking::where('driver_id', $driverId)->orderBy('created_at', 'desc')->get();
        return view('driver.assign-bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        // ensure only assigned driver can update
        if ($booking->driver_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        if ($request->status === 'on_truck') {
            $booking->on_truck_at = now();
        } elseif ($request->status === 'delivered') {
            $booking->delivered_at = now();
        }
    
        $booking->save();
    
        return back()->with('success', 'Booking status updated successfully.');
    }
    
}
