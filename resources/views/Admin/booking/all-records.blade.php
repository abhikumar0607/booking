@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Bookings</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatables"
                                        class="display table table-striped table-hover dataTable" role="grid"
                                        aria-describedby="basic-datatables_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Sender Name</th>
                                                <th>PickUp Address</th>
                                                <th>Recipient Name</th>
                                                <th>Delivery Address</th>
                                                <th>Recepient Phone</th>
                                                <th>Delivery Notes</th>
                                                <th>Items</th>
                                                <th>Price</th>
                                                <th>Assign Drivers</th>
                                                <th>Print Delivery Docket</th>
                                                <th>Invoice</th>
                                                <th>Booking Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($bookings) >= 1)
                                            @foreach($bookings as $booking)
                                            <tr role="row" class="odd" id="booking-row-{{ $booking->id }}">
                                                <td class="sorting_1">{{ $booking->sender_name }}</td>
                                                <td>{{ $booking->pickup_address }}</td>
                                                <td>{{ $booking->recipient_name }}</td>
                                                <td>{{ $booking->delivery_address }}</td>
                                                <td>{{ $booking->recipient_phone }}</td>
                                                <td>{{ $booking->delivery_notes }}</td>
                                                <td>{{ $booking->item_type }}</td>
                                                <td>{{ $booking->price }}</td>
                                                <td>
                                                    <select class="form-control driver-select" name="driver_id" data-booking-id="{{ $booking->id }}" {{ $booking->driver_id ? 'disabled' : '' }}>
                                                        <option value="">Select Driver</option>
                                                        @foreach($drivers as $driver)
                                                        @php
                                                        $isOnline = $driver->last_activity && \Carbon\Carbon::parse($driver->last_activity)->gt(now()->subMinutes(2));
                                                        $emoji = $isOnline ? '🟢' : '🔴';
                                                        @endphp
                                                        <option
                                                            value="{{ $driver->id }}"
                                                            data-emoji="{{ $emoji }}"
                                                            data-status="{{ $isOnline ? 'online' : 'offline' }}"
                                                            {{ $booking->driver_id == $driver->id ? 'selected' : '' }}>
                                                            {{ $driver->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div id="driver-message-{{ $booking->id }}" class="mt-2"></div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success generate-label"
                                                        data-booking='@json($booking)'>
                                                        Print Label
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary generate-invoice"
                                                        data-booking='@json($booking)'>
                                                        Download Invoice
                                                    </button>
                                                </td>
                                                <td>
                                                    @if($booking->on_truck_at)
                                                    <span class="badge badge-warning">On Truck: {{ \Carbon\Carbon::parse($booking->on_truck_at)->format('d M Y H:i') }}</span><br>
                                                    @endif
                                                    @if($booking->delivered_at)
                                                    <span class="badge badge-success">Delivered: {{ \Carbon\Carbon::parse($booking->delivered_at)->format('d M Y H:i') }}</span>
                                                    @endif
                                                    @if(!$booking->on_truck_at && !$booking->delivered_at)
                                                    <span class="badge badge-secondary">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="booking/delete/{{ $booking->id }}" class="delt-cr" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a> |
                                                    <a href="booking/edit/{{ $booking->id }}" class="delt-cr">Edit</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="12">No bookings found</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.driver-select').select2({
            templateResult: formatDriver,
            templateSelection: formatDriver
        });

        function formatDriver(driver) {
            if (!driver.id) return driver.text;
            var emoji = $(driver.element).data('emoji');
            return $('<span><span class="driver-emoji">' + emoji + '</span> ' + driver.text + '</span>');
        }
    });
</script>
@endsection