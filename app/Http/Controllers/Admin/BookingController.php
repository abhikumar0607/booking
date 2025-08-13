<?php

namespace App\Http\Controllers\Admin;

use App\Mail\DriverAssignedMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Booking;

class BookingController extends Controller
{
    //function for view all records
    public function index(){

        $bookings = Booking::orderBy('created_at', 'desc')->get();
        $drivers = User::where('user_type', 'driver')->get();
        return view('Admin.booking.all-records', compact('bookings', 'drivers'));
    }
    //function to assign driver to booking
    public function assignDriver(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'driver_id' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) {
                    $query->where('user_type', 'Driver');
                }),
            ],
        ]);

        // Now safe to assign
        $booking = Booking::find($request->booking_id);

        if ($booking->driver_id) {
            return response()->json([
                'success' => false,
                'message' => 'Booking already assigned.'
            ]);
        }

        $booking->driver_id = $request->driver_id;
        $booking->status = 'assigned';
        $booking->save();

        $driver = User::find($request->driver_id);
        if ($driver && $driver->email) {
            Mail::to($driver->email)->send(new DriverAssignedMail($booking));
        }

        return response()->json(['success' => true]);
    }
    
}
