<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HowItWork;
use Illuminate\Http\Request;

class HowItWorkController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $items = HowItWork::all();
        return view('Admin.how-it-work.all-how-it-works', compact('items'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('Admin.how-it-work.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text' => 'required|string|max:255',
            'button_link' => 'required|url|max:255',
            'section1_title' => 'required|string|max:255',
            'section1_desc' => 'required|string',
            'section2_title' => 'required|string|max:255',
            'section2_desc' => 'required|string',
            'section3_title' => 'required|string|max:255',
            'section3_desc' => 'required|string',
            'section4_title' => 'required|string|max:255',
            'section4_desc' => 'required|string',      
        ]);
        // Image Upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/howitworks'), $imageName);
            $data['image'] = 'images/howitworks/' . $imageName;
        }

        $data['status'] = 'inactive';
        $is_submit = HowItWork::create($data);
        if($is_submit){
        return redirect()->back()->with('success', 'Section added successfully (inactive by default).');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Edit function
    public function edit($id)
    {
        $howItWork = HowItWork::findOrFail($id); // id ke base par record fetch
        return view('admin.how-it-work.edit-how-it-work', compact('howItWork'));
    }
    
    // Update function
    public function update(Request $request, $id)
    {
        $howItWork = HowItWork::findOrFail($id); // id ke base par record fetch
        $data = $request->all();
    
        // Image update
        if ($request->hasFile('image')) {
            // Purani image delete kar de agar hai
            if ($howItWork->image && file_exists(public_path($howItWork->image))) {
                unlink(public_path($howItWork->image));
            }
    
            // Nayi image save kar
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/howitworks'), $imageName);
            $data['image'] = 'images/howitworks/' . $imageName;
        }
    
        // Active status ko unique rakhna
        if (isset($data['status']) && $data['status'] === 'active') {
            HowItWork::where('status', 'active')
                     ->where('id', '!=', $howItWork->id)
                     ->update(['status' => 'inactive']);
        }
    
        $is_updated = $howItWork->update($data);
    
        if ($is_updated) {
            return redirect()->back()->with('success', 'Updated successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    
    // Delete function
    public function delete_howitwork($id)
    {
        $item = HowItWork::find($id);

        if ($item) {
            // Agar image hai to delete kar
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            $item->delete();

            return redirect()->back()->with('success', 'Section deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Section not found.');
        }
    }

}
