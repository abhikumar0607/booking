<?php

namespace App\Http\Controllers\Driver;

use App\Mail\DriverCreatedMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class DriverController extends Controller
{
    //view form for adding a new driver
    public function add_new_driver()
    {
        return view('Admin.Driver.add-driver');
    }
    //submit driver data    
    public function submit_driver(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:12',
        ]);
        // Strong Random Password Generate
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%^&*()';
        $plainPassword = substr(str_shuffle(str_repeat($characters, 5)), 0, 10);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($plainPassword),
            'phone'     => $request->phone,
            'user_type' => 'driver',
        ]);

        // Send Email with Plain Password
        Mail::to($user->email)->send(new DriverCreatedMail($user->name, $user->email, $plainPassword));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Driver added successfully and email sent!');
    }
    //view all drivers
    public function view_drivers()
    {
        $drivers = User::where('user_type', 'driver')->get();
        return view('Admin.Driver.all-drivers', compact('drivers'));
    }

    //delete driver
    public function delete_driver($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Driver deleted successfully!');
    }
}