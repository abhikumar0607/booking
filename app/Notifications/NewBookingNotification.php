<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewBookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        // Store in DB (for dashboard) + broadcast (for real-time updates)
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'customer_name' => $this->booking->sender_name,
            'message' => 'New booking received from ' . $this->booking->sender_name,
            'url' => url('/admin/bookings/'),
        ];
    }


}
