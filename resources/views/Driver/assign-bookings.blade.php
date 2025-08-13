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
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Booking Id</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 366.578px;">Pickup</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                    style="width: 187.688px;">Delivery</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 84.5px;">Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 84.5px;">Invoice</th>
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