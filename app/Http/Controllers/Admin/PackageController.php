<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
class PackageController extends Controller
{
    //function to add packages
    public function addPackage() {
        return view('Admin.package.add-package');
    }
    
    //function to submit package
    public function submitPackage(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
    
        // Check if package with same name already exists
        if (Package::where('name', $data['name'])->exists()) {
            return redirect()->back()->with('error', 'Package with this name already exists.');
        }
    
        $data['status'] = 'active';    
        $is_submit = Package::create($data);
    
        if($is_submit){
            return redirect()->back()->with('success', 'Package added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    
    //function to view all packages
    public function allPackages() {
        $packages = Package::all();
        return view('Admin.package.all-packages', compact('packages'));
    }
    //function to delete package
    public function deletePackage($id) {
        $package = Package::findOrFail($id);
        $is_delete = $package->delete();
        if($is_delete){
            return redirect()->back()->with('success', 'Package deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    //function to edit package
    public function editPackage($id) {
        $package = Package::findOrFail($id);
        return view('Admin.package.edit-package', compact('package'));
    }

    //function to update package
    public function updatePackage(Request $request, $id) {
        $data = $request->validate([
            'name' => 'required|string|max:255',            
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);
        $package = Package::findOrFail($id);
        $is_update = $package->update($data);
        if($is_update){
            return redirect()->back()->with('success', 'Package updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
        
