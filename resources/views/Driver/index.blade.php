@extends('Driver.Layout.master')

@section('content')
<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-3">Dashboard</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary bubble-shadow-small">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Bookings</p>
                <h4 class="card-title">{{ $bookings->count() }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>

  <div class="row">
    <!-- User Statistics -->
    <div class="col-md-12">
      <div class="card card-round">
        <div class="card-header">
          <div class="card-head-row">
            <div class="card-title">New Assigned Bookings</div>
          </div>
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