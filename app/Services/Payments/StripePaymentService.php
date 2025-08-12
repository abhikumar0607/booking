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
    public function pay($amount, $currency = 'usd')
    {
        if (!$this->stripeToken) {
            throw new \Exception("Stripe token is missing. Cannot process payment.");
        }
    
        // Extract amount if passed as array
        if (is_array($amount)) {
            $amount = $amount['amount'] ?? 0;
        }
    
        // Convert string like "840.00" to float
        $amount = (float) $amount;
    
        if ($amount <= 0) {
            throw new \Exception("Invalid payment amount.");
        }
    
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    
        return \Stripe\Charge::create([
            'amount' => (int) round($amount * 100), // convert to cents
            'currency' => $currency,
            'source' => $this->stripeToken,
            'description' => 'Booking Payment',
            'shipping' => [
                'name' => 'John Doe',
                'address' => [
                    'line1'       => '123 Main Street',
                    'city'        => 'New York',
                    'state'       => 'NY',
                    'postal_code' => '10001',
                    'country'     => 'US',
                ],
            ],
        ]);
    }
    
    
}
