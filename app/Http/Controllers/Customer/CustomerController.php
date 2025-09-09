<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class CustomerController extends Controller
{
     //view form for adding a new customer
     public function add_customer()
     {
         return view('Admin.customer.add-customer');
     }

     //function for adding a new customer
     public function submit_customer(Request $request)
     {
        $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  =>  'required', 'regex:/^[0-9]{6,15}$/',
            'phone_code' => 'required|string|in:"02","03","04","07","08","1300","1800"',
            'pickup_address' => 'required|string|max:255',
        ]);

        // Generate unique customer number with prefix
        do {
            $customerNumber = 'CUS' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (User::where('customer_number', $customerNumber)->exists());

        // Generate unique code with prefix
        do {
            $code = 'CD' . str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);
        } while (User::where('code', $code)->exists());

        // Email aur password customer_number ke base pe
        $email = strtolower($customerNumber) . '@gmail.com';
        $password = $customerNumber;

        // Create user
        $is_created = User::create([
            'name'            => $request->name,
            'phone'           => $request->phone,
            'phone_code'      => $request->phone_code,
            'pickup_address'  => $request->pickup_address,
            'user_type'       => 'Customer',
            'customer_number' => $customerNumber,
            'code'            => $code,
            'email'           => $email,
            'password'        => Hash::make($password),
        ]);

        if($is_created){
            return redirect()->back()->with('success', "Customer created!");
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }        
     }

     //view all customers
     public function view_customers()
     {
        $customers = User::where('user_type', 'Customer')->get();
        return view('Admin.customer.all-customers', compact('customers'));
     }
  
     //edit customer
     public function edit_customer($id)
     {
        $customer = User::find($id);
        return view('Admin.customer.edit-customer', compact('customer'));
     }

     //update customer
     public function update_customer(Request $request, $id)
     {
        $data = [
            'name'            => $request->name,
            'phone'           => $request->phone,
            'phone_code'      => $request->phone_code,
            'pickup_address'  => $request->pickup_address,
        ];

        $is_updated = User::where('id', $id)->update($data);

        if($is_updated){
            return redirect()->back()->with('success', 'Customer updated successfully!');
        }else{
            return redirect()->back()->with('error', 'Nothing to update!');
        }
        
     }
     
     //delete customer
     public function delete_customer($id)
     {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully!');
     }
     
}
