<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;

class LogoController extends Controller
{
    
    // add logo
    public function add_logo()
    {
        return view('Admin.logo.add-logo');
    }
    // submit logo
    public function submit_logo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $imageName = time().'.'.$request->logo->extension();
        $request->logo->move(public_path('images/logos'), $imageName);

       $is_submit = Logo::create([
            'logo' => $imageName,
            'status' => 'Active', // "Active" mat do, DB column ke hisaab se do
        ]);
        if($is_submit){
        return redirect()->back()->with('success', 'Logo added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // view logos
    public function index()
    {
        $logos = Logo::all();
        return view('Admin.logo.all-logos', compact('logos'));
    }

    // delete logo
    public function delete_logo($id)
    {
        $logo = Logo::find($id);
        if ($logo) {
            $imagePath = public_path('images/logos/' . $logo->logo);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            $logo->delete();
            return redirect()->back()->with('success', 'Logo deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Logo not found.');
        }
    }
}
