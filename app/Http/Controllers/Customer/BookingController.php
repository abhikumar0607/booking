<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Payments\PaymentServiceInterface;

use App\Models\Booking;

class BookingController extends Controller
{
    private PaymentServiceInterface $paymentService;

    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    
    //function for view form
    public function index()
    {
        return view('Customer/booking-form');
    }
    public function store_data(Request $request)
    {
         $data = $request->all();
        //echo "<pre>"; print_r($data); echo "</pre>";exit;
        foreach ($data['item_type'] as $index => $type) {
            if (empty($type)) {
                continue; // skip empty item_type entries
            }
        
            Booking::create([
                'sender_name'      => $data['sender_name'],
                'sender_phone'     => $data['sender_phone'],
                'pickup_address'   => $data['pickup_address'],
                'recipient_name'   => $data['recipient_name'],
                'recipient_phone'  => $data['recipient_phone'],
                'delivery_address' => $data['delivery_address'],
                'delivery_notes'   => $data['delivery_notes'] ?? null,
                'item_type'        => $type,
                'number_of_items'  => $data['number_of_items'][$index] ?? 1,
                'price'            => $data['price'][$index] ?? 0,
            ]);
        }
        return back()->with('success', 'Booking created successfully!');
    }
        
}