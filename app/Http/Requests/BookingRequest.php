<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'sender_name'      => 'required|string|max:255',
            'pickup_address'   => 'required|string',
            'recipient_name'   => 'required|string|max:255',
            'delivery_address' => 'required|string',
            'recipient_phone'  => 'required|string|max:20',
            'delivery_notes'   => 'nullable|string',
            'delivery_type'    => 'required|in:Same Day,Overnight',
            'item_type'        => 'required|in:Small,Medium,Large',
            'number_of_items'  => 'required|integer|min:1',
            'measurements'     => 'nullable|string',
            'price'            => 'required|numeric',
            'payment_method'  => 'required|in:Stripe,Cash on Delivery',
            'stripe_token'    => 'required_if:payment_method,Stripe'
        ];
    }
}
