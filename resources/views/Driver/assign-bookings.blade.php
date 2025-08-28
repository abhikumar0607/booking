@extends('Driver.Layout.master')
@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Assigned Bookings</h4>
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
                                                <th>Booking Id</th>
                                                <th>Status</th>
                                                <th>Pickup</th>
                                                <th>Delivery</th>
                                                <th>Date</th>
                                                <th>Print Delivery Docket</th>
                                                <th>Invoice</th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->id }}</td>
                                                    <td>{{ ucfirst($booking->status) }}</td>
                                                    <td>{{ $booking->pickup_address }}</td>
                                                    <td>{{ $booking->delivery_address }}</td>
                                                    <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success generate-label"
                                                            data-booking='@json($booking)'>
                                                            Print Label
                                                        </button>
                                                        <form action="{{ route('driver.bookings.updateStatus', $booking->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="status" value="on_truck">
                                                            <button type="submit" class="btn btn-warning btn-sm"
                                                                {{ $booking->on_truck_at ? 'disabled' : '' }}>
                                                                On Truck
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('driver.bookings.updateStatus', $booking->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="status" value="delivered">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                {{ $booking->delivered_at ? 'disabled' : '' }}>
                                                                Delivered
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary generate-invoice" 
                                                                data-booking='@json($booking)'>
                                                            Download Invoice
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">No bookings assigned yet.</td>
                                                </tr>
                                            @endforelse
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
@endsection