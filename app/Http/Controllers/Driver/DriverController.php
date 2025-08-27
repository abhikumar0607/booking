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
    //view edit driver form
    public function edit_driver($id)
    {
        $driver = User::find($id);
        return view('Admin.Driver.edit-driver', compact('driver'));
    }
    //update driver
    public function update_driver(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'phone'    => 'required|string|max:12',
        ]);
        $is_updated = User::where('id', $id)->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
        ]);
        if ($is_updated) {
            return redirect()->back()->with('success', 'Driver updated successfully!');
        }else{
            return redirect()->back()->with('error', 'Nothing to update!');
        }        
    }
    //delete driver
    public function delete_driver($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Driver deleted successfully!');
    }
}