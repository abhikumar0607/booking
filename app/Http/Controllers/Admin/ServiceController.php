<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    // add service
    public function add_service()
    {
        return view('Admin.service.add-service');
    }

    // submit service
    public function submit_service(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/services'), $imageName);
        }

        $is_submit = Service::create([
            'name' => $request->name,
            'image' => $imageName,
            'status' => 'Active', // "Active" mat do, DB column ke hisaab se do
        ]);
        if($is_submit){       

        return redirect()->back()->with('success', 'Service added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // view services
    public function index()
    {
        $services = Service::all();
        return view('Admin.service.all-services', compact('services'));
    }

    // delete service
    public function delete_service($id)
    {
        $service = Service::find($id);
        if ($service) {
            $imagePath = public_path('images/services/' . $service->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            $service->delete();
            return redirect()->back()->with('success', 'Service deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Service not found.');
        }
    }
}
