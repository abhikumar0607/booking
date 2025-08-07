<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
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

    //function for store data
    public function store(BookingRequest $request)
    {
        $data = $request->validated();
        // StepCreate Booking
        $booking = Booking::create([
            'sender_name'     => $data['sender_name'],
            'pickup_address'  => $data['pickup_address'],
            'recipient_name'  => $data['recipient_name'],
            'delivery_address'=> $data['delivery_address'],
            'recipient_phone' => $data['recipient_phone'],
            'delivery_notes'  => $data['delivery_notes'] ?? null,
            'item_type'       => $data['item_type'],
            'number_of_items' => $data['number_of_items'],
            'price'           => $data['price'],
        ]);

        // StepProcess Payment
        $this->paymentService->pay(array_merge($data, ['booking_id' => $booking->id]));
        return redirect()->back()->with('success', 'Booking created successfully!');
    }

}
