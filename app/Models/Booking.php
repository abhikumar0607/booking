<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     protected $fillable = [
        'sender_name',
        'pickup_address',
        'recipient_name',
        'delivery_address',
        'recipient_phone',
        'delivery_notes',
        'item_type',
        'number_of_items',
        'price'
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
