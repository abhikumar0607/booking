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

        // Filter and format item types
        $filteredItemTypes = array_filter($data['item_type'] ?? [], fn($type) => !empty($type));
        $itemTypeString = implode(', ', $filteredItemTypes);
        $totalPrice = $data['total_price'] ?? 0;

        // If Stripe is selected → process payment before saving booking
        if ($request->payment_method === 'Stripe') {
            $paymentResult = $this->paymentService->pay([
                'amount'   => $totalPrice, // Stripe uses cents
                'currency' => 'aud',
                'source'   => $request->stripe_token, // From Stripe Checkout/Elements
                'description' => 'Booking payment for ' . $itemTypeString,
            ]);

            if (!$paymentResult['success']) {

                 // Save booking only if payment successful or COD
                Booking::create([
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
                    'payment_status'   => $request->payment_method === 'Stripe' ? 'Paid' : 'Pending',
                ]);
                return back()->with('success', 'Booking created successfully!');
                return back()->withErrors(['payment' => 'Payment failed: ' . $paymentResult['message']]);
            }
        }

        
       
    }

}