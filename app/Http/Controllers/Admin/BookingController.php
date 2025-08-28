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

    // Show edit form
    public function edit_booking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('Admin.booking.edit-booking', compact('booking'));
    }

    // Handle form submission
    public function update_booking(Request $request, $id)
    {
        $request->validate([
            'sender_name'      => 'required|string|max:255',
            'sender_phone'     => 'required|string|max:20',
            'pickup_address'   => 'required|string|max:500',
            'recipient_name'   => 'required|string|max:255',
            'recipient_phone'  => 'required|string|max:20',
            'delivery_address' => 'required|string|max:500',
            'delivery_notes'   => 'nullable|string|max:500',         
            'payment_status'   => 'required|in:Pending,Paid,Failed',
        ]);
        $booking = Booking::findOrFail($id);
        $is_updated = $booking->update($request->all());
        if($is_updated){
            return redirect()->back()->with('success', 'Booking Updated Successfully!');
           
        }else{
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
        
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
            Mail::to($driver->email)->send(new DriverAssignedMail($booking, $driver));
        }

        return response()->json(['success' => true]);
    }

    //function to delete booking
    public function delete_booking($id)
    {
        Booking::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }

    
       
}
