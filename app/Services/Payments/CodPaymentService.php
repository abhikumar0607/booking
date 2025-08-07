<?php

namespace App\Services\Payments;

use App\Models\Payment;

class CodPaymentService implements PaymentServiceInterface
{
    public function pay(array $data)
    {
        // 1. Save Payment Record without charging
        Payment::create([
            'booking_id'     => $data['booking_id'],
            'payment_method' => 'Cash on Delivery',
            'payment_status' => 'pending',
            'transaction_id' => null
        ]);

        // 2. Return result
        return [
            'status' => 'pending',
            'id'     => null
        ];
    }
}
