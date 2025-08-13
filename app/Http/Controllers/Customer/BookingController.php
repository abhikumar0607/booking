<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Payments\PaymentServiceInterface;

use App\Models\Booking;
use App\Models\Payment;
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
    
        // Filter and format item types
        $filteredItemTypes = array_filter($data['item_type'] ?? [], fn($type) => !empty($type));
        $itemTypeString = implode(', ', $filteredItemTypes);
        $totalPrice = $data['total_price'] ?? 0;
    
        if ($request->payment_method === 'Stripe') {
            // Call payment service
            $paymentResult = $this->paymentService->pay([
                'amount'      => $totalPrice,
                'currency'    => 'aud',
                'description' => 'Booking payment for ' . $itemTypeString,
                'sender_name' => $data['sender_name'],
            ]);
    
            if (!$paymentResult['success']) {
                return back()->withErrors(['payment' => 'Payment failed: ' . $paymentResult['message']]);
            }
    
            // Payment success — create booking with Paid status
            $paymentStatus = 'Paid';
        } else {
            // For other payment methods like COD
            $paymentStatus = 'Pending';
            $paymentResult = [
                'transaction_id' => null,
            ];
        }
    
        // Create booking
        $booking = Booking::create([
            'sender_name'      => $data['sender_name'],
            'sender_phone'     => $data['sender_phone'],
            'pickup_address'   => $data['pickup_address'],
            'recipient_name'   => $data['recipient_name'],
            'recipient_phone'  => $data['recipient_phone'],
            'delivery_address' => $data['delivery_address'],
            'delivery_notes'   => $data['delivery_notes'] ?? null,
            'item_type'        => $itemTypeString,
            'number_of_items'  => array_sum($data['number_of_items'] ?? []),
            'price'            => $totalPrice,
            'payment_status'   => $paymentStatus,
        ]);
    
        // Create payment record
        Payment::create([
            'booking_id'     => $booking->id,
            'payment_method' => $request->payment_method,
            'payment_status' => $paymentStatus,
            'transaction_id' => $paymentResult['transaction_id'] ?? null,
        ]);
    
        return back()->with('success', 'Booking created successfully!');
    }
        

}