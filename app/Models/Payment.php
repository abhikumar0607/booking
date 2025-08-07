<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
      protected $fillable = [
        'booking_id',
        'payment_method',
        'payment_status',
        'transaction_id'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
