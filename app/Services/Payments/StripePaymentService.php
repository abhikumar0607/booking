<?php

namespace App\Services\Payments;

use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentService implements PaymentServiceInterface
{
    protected $stripeToken;

    public function __construct($stripeToken = null)
    {
        // Avoid undefined array key by safely assigning the token
        $this->stripeToken = $stripeToken ?? request()->input('stripe_token', null);
    }
    public function pay(array $data)
    {
        try {
            $amount = $data['amount'] ?? 0;
            $currency = $data['currency'] ?? 'aud';
            $description = $data['description'] ?? 'Booking Payment';
            $senderName = $data['sender_name'] ?? 'John Doe';

            if (!$this->stripeToken) {
                return [
                    'success' => false,
                    'message' => 'Stripe token is missing. Cannot process payment.',
                    'transaction_id' => null,
                ];
            }

            $amount = (float) $amount;

            if ($amount <= 0) {
                return [
                    'success' => false,
                    'message' => 'Invalid payment amount.',
                    'transaction_id' => null,
                ];
            }

            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $charge = \Stripe\Charge::create([
                'amount' => (int) round($amount * 100),
                'currency' => $currency,
                'source' => $this->stripeToken,
                'description' => $description,
                'shipping' => [
                    'name' => $senderName,
                    'address' => [
                        'line1'       => '123 Main Street',
                        'city'        => 'New York',
                        'state'       => 'NY',
                        'postal_code' => '10001',
                        'country'     => 'US',
                    ],
                ],
            ]);

            if ($charge->status === 'succeeded') {
                return [
                    'success' => true,
                    'message' => 'Payment successful.',
                    'transaction_id' => $charge->id,
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Payment failed with status: ' . $charge->status,
                    'transaction_id' => null,
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Payment exception: ' . $e->getMessage(),
                'transaction_id' => null,
            ];
        }
    }   
    
}
