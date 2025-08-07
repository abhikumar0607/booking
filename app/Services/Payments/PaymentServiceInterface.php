<?php

namespace App\Services\Payments;

interface PaymentServiceInterface
{
    public function pay(array $data);
}
