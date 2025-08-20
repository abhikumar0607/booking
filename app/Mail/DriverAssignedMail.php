<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DriverAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $driver;

    /**
     * Create a new message instance.
     */
    public function __construct($booking, $driver)   // <-- dono parameters accept karo
    {
        $this->booking = $booking;
        $this->driver = $driver;   // <-- yaha assign karo
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Booking Assigned')
                    ->view('Admin.emails.driver_assigned');
    }
}
