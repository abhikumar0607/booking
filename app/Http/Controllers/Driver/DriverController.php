<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DriverController extends Controller
{
    //view form for adding a new driver
    public function add_new_driver()
    {        return view('Admin.Driver.add-driver');
    }
    //submit driver data
    public function submit_driver(Request $request)
    {
        $data = $request->all();
       //echo "<pre>"; print_r($data); die;
        // Create a new driver user
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['email']),
            'phone' => $data['phone'],
            'user_type' => 'driver',
        ]);
        // Redirect back with success message
        return redirect()->back()->with('success', 'Driver added successfully!');   
    }
    //view all drivers
    public function view_drivers()
    {
        $drivers = User::where('user_type', 'driver')->get();
        return view('Admin.Driver.all-drivers', compact('drivers'));
    }

}
