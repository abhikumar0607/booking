<?php

namespace App\Http\Controllers\Admin;

use App\Mail\DriverAssignedMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    $booking = Booking::findOrFail($request->booking_id);

    // Agar booking kisi driver ko already assigned hai aur naye driver ka ID same hai
    if ($booking->driver_id == $request->driver_id) {
        return response()->json([
            'success' => false,
            'message' => 'This driver is already assigned to the booking.'
        ]);
    }

    // Purane driver ko hatao aur naye driver ko assign karo
    $oldDriverId = $booking->driver_id;
    $booking->driver_id = $request->driver_id;
    $booking->status = 'assigned';
    $booking->save();

    // Naye driver ko mail bhejna
    $driver = User::find($request->driver_id);
    if ($driver && $driver->email) {
        Mail::to($driver->email)->send(new DriverAssignedMail($booking, $driver));
    }

    return response()->json([
        'success' => true,
        'message' => $oldDriverId 
            ? 'Driver reassigned successfully!' 
            : 'Driver assigned successfully!'
    ]);
}


    //function to delete booking
    public function delete_booking($id)
    {
        Booking::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:on_truck,delivered',
        ]);
    
        if ($request->status === 'on_truck') {
            $booking->on_truck_at = now();
            $booking->delivered_at = null; // reset delivered
        } elseif ($request->status === 'delivered') {
            $booking->delivered_at = now();
            $booking->on_truck_at = null; // reset on_truck
        }
    
        $booking->status = $request->status;
        $booking->save();
    
        return back()->with('success', 'Booking status updated successfully by Admin!');
    }
    

       
}
