<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Payments\PaymentServiceInterface;
use App\Services\Payments\StripePaymentService;
use App\Services\Payments\CodPaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        // PaymentServiceInterface को सही Service से bind करना
        $this->app->bind(PaymentServiceInterface::class, function ($app) {
            // Request से Payment Method लो (default COD)
            $method = request()->input('payment_method', 'Cash on Delivery');
            return match ($method) {
                'Stripe' => new StripePaymentService(),
                'Cash on Delivery' => new CodPaymentService(),
                default => throw new \Exception("Payment method not supported"),
            };
        });
    }

    public function boot() {}
}
