@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All records</h4>
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Sender Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 366.578px;">PickUp Address</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                    style="width: 187.688px;">Recipient Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 84.5px;">Delivery Address</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Start date: activate to sort column ascending"
                                                    style="width: 184.234px;">Recepient Phone</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 156.312px;">Delivery Notes</th>
                                                 <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 156.312px;">Items</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 156.312px;">Price</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 156.312px;">Assign Drivers</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 156.312px;">Invoice</th>
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
                                                                {{ $booking->driver_id == $driver->id ? 'selected' : '' }}
                                                            >
                                                                {{ $driver->name }}
                                                    </option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary generate-invoice" 
                                                                data-booking='@json($booking)'>
                                                            Download Invoice
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9">No bookings found</td>
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
document.addEventListener("DOMContentLoaded", function () {
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