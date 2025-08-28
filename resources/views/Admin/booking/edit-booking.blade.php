@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Booking #{{ $booking->id }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="sender_name" class="form-label">Sender Name</label>
                            <input type="text" name="sender_name" class="form-control" value="{{ old('sender_name', $booking->sender_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="sender_phone" class="form-label">Sender Phone</label>
                            <input type="text" name="sender_phone" class="form-control" value="{{ old('sender_phone', $booking->sender_phone) }}">
                        </div>

                        <div class="form-group">
                            <label for="pickup_address" class="form-label">Pickup Address</label>
                            <textarea name="pickup_address" class="form-control">{{ old('pickup_address', $booking->pickup_address) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient_name" class="form-label">Recipient Name</label>
                            <input type="text" name="recipient_name" class="form-control" value="{{ old('recipient_name', $booking->recipient_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="recipient_phone" class="form-label">Recipient Phone</label>
                            <input type="text" name="recipient_phone" class="form-control" value="{{ old('recipient_phone', $booking->recipient_phone) }}">
                        </div>

                        <div class="form-group">
                            <label for="delivery_address" class="form-label">Delivery Address</label>
                            <textarea name="delivery_address" class="form-control">{{ old('delivery_address', $booking->delivery_address) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="delivery_notes" class="form-label">Delivery Notes</label>
                            <textarea name="delivery_notes" class="form-control">{{ old('delivery_notes', $booking->delivery_notes) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select name="payment_status" class="form-select">
                                @foreach(['Pending', 'Paid'] as $payment)
                                <option value="{{ $payment }}" {{ $booking->payment_status == $payment ? 'selected' : '' }}>{{ $payment }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection