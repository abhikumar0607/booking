<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    //function for view all records
    public function index(){
        $bookings = Booking::orderBy('id', 'DESC')->get();
        return view('Admin.booking.all-records', compact('bookings'));
    }
}
