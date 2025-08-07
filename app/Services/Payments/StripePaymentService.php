<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentService implements PaymentServiceInterface
{
    public function pay(array $data)
    {
        // 1. Set API Key
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // 2. Create Stripe Charge
         $charge = Charge::create([
            'amount' => $data['price'] * 100, // amount in paise
            'currency' => 'inr',
            'source' => $data['stripe_token'],
            'description' => 'Booking Payment',
            'shipping' => [
                'name' => $data['sender_name'] ?? 'Unknown Sender',
                'address' => [
                    'line1' => $data['pickup_address'] ?? 'No Address',
                    'city' => 'Unknown City',
                    'country' => 'IN',
                ],
            ],
            'metadata' => [
                'recipient_name' => $data['recipient_name'] ?? '',
                'delivery_address' => $data['delivery_address'] ?? '',
            ]
        ]);

        // 3. Save Payment Record
        Payment::create([
            'booking_id'     => $data['booking_id'],
            'payment_method' => 'Stripe',
            'payment_status' => $charge->status,
            'transaction_id' => $charge->id,
        ]);

        // 4. Return status
        return [
            'status' => $charge->status,
            'id'     => $charge->id
        ];
    }
}
