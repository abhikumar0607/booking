<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewBookingNotification;
use App\Services\Payments\PaymentServiceInterface;
use App\Mail\NewBookingMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
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
        //Validate Inputs
        $validated = $request->validate([
            'sender_name'      => 'required|string|max:255',
            'sender_state_code' => 'required|string|in:"02","03","04","07","08","1300","1800"',
            'sender_phone'     => ['required', 'regex:/^[0-9]{6,15}$/'], 
            'pickup_address'   => 'required|string|max:500',
            'recipient_state_code' => 'required|string|in:"02","03","04","07","08","1300","1800"',
            'recipient_name'   => 'required|string|max:255',
            'recipient_phone'  => ['required', 'regex:/^[0-9]{6,15}$/'], 
            'delivery_address' => 'required|string|max:500',    
            'delivery_notes'   => 'nullable|string|max:1000',
            'number_of_items.*'=> 'nullable|integer|min:1',
            'payment_method'   => 'required|in:Stripe,Cash on Delivery',
            'total_price'      => 'required|numeric|min:1', 
        ]);
        $senderPhone = $validated['sender_state_code'] . $validated['sender_phone']; 
        $recipientPhone = $validated['recipient_state_code'] . $validated['recipient_phone'];
        //Format package data
        $filteredItemTypes = array_filter($validated['item_type'] ?? [], fn($type) => !empty($type));
        $itemTypeString = implode(', ', $filteredItemTypes);
        $totalPrice = $validated['total_price'];

        //Payment Logic
        if ($validated['payment_method'] === 'Stripe') {
            $paymentResult = $this->paymentService->pay([
                'amount'      => $totalPrice,
                'currency'    => 'aud',
                'description' => 'Booking payment for ' . $itemTypeString,
                'sender_name' => $validated['sender_name'],
            ]);

            if (!$paymentResult['success']) {
                return back()->withErrors(['payment' => 'Payment failed: ' . $paymentResult['message']])
                            ->withInput();
            }

            $paymentStatus = 'Paid';
        } else {
            $paymentStatus = 'Pending';
            $paymentResult = [
                'transaction_id' => null,
            ];
        }

        //Create Booking
        $booking = Booking::create([
            'sender_name'      => $validated['sender_name'],
            'sender_phone'     => $senderPhone,
            'pickup_address'   => $validated['pickup_address'],
            'recipient_name'   => $validated['recipient_name'],
            'recipient_phone'  => $recipientPhone,
            'delivery_address' => $validated['delivery_address'],
            'delivery_notes'   => $validated['delivery_notes'] ?? null,
            'item_type'        => $itemTypeString,
            'number_of_items'  => array_sum($validated['number_of_items'] ?? []),
            'price'            => $totalPrice,
            'payment_status'   => $paymentStatus,
        ]);

        //Save Payment Record
        Payment::create([
            'booking_id'     => $booking->id,
            'payment_method' => $validated['payment_method'],
            'payment_status' => $paymentStatus,
            'transaction_id' => $paymentResult['transaction_id'] ?? null,
        ]);

        $admins = User::where('user_type', 'admin')->get();
        Notification::send($admins, new NewBookingNotification($booking));
        // Send email to all admins
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewBookingMail($booking));
        }
        return back()->with('success', 'Booking created successfully!');
    }

    public function fetch_customer(Request $request)
    {
        $request->validate([
            'customer_number' => 'required',
            'code' => 'required',
        ]);

        $user = User::where('customer_number', $request->customer_number)
                    ->where('code', $request->code)
                    ->first();

        if ($user) {
            return response()->json([
                'status' => true,
                'name' => $user->name,
                'phone' => $user->phone,
                'phone_code' => $user->phone_code, 
                'pickup_address' => $user->pickup_address,
                'phone_code' => $user->phone_code, 
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Customer not found']);
    }


}