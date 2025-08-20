@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="mb-3">Dashboard</h3>
      @php
    $unreadCount = auth()->user()->unreadNotifications->count();
@endphp

<div class="dropdown">
    <button class="btn position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell fs-4"></i> <!-- Bootstrap Icon Bell -->
        @if($unreadCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <ul class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 400px; overflow-y:auto;">
        <li class="fw-bold mb-2">Notifications</li>
        @forelse(auth()->user()->unreadNotifications as $notification)
            <li>
                <a href="{{ route('admin.bookings.show', $notification->data['booking_id']) }}" 
                   class="dropdown-item d-flex align-items-start">
                    <i class="bi bi-box-seam me-2 text-primary"></i>
                    <div>
                        <div>{{ $notification->data['message'] }}</div>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </a>
            </li>
        @empty
            <li><span class="dropdown-item text-muted">No new notifications</span></li>
        @endforelse
    </ul>
</div>


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

    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-info bubble-shadow-small">
                <i class="fas fa-user-check"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Drivers</p>
                <h4 class="card-title">{{ $drivers->count() }}</h4>
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
            <div class="card-title">New Bookings</div>
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
                        <th>Sender Name</th>
                        <th>PickUp Address</th>
                        <th>Recipient Name</th>
                        <th>Delivery Address</th>
                        <th>Recepient Phone</th>
                        <th>Delivery Notes</th>
                        <th>Items</th>
                        <th>Price</th>
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

    <!-- New Customers -->
    <div class="col-md-12">
      <div class="card card-round">
        <div class="card-body">
          <div class="card-head-row card-tools-still-right">
            <div class="card-title">New Drivers</div>
          </div>

          <div class="card-list py-4">

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
                            style="width: 242.688px;">Name</th>

                          <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                            rowspan="1" colspan="1" aria-sort="ascending"
                            aria-label="Name: activate to sort column descending"
                            style="width: 242.688px;">Email</th>

                          <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                            rowspan="1" colspan="1" aria-sort="ascending"
                            aria-label="Name: activate to sort column descending"
                            style="width: 242.688px;">Phone</th>

                        </tr>
                      </thead>
                      <tbody>
                        @if(count($drivers) >= 1)
                        @foreach($drivers as $driver)
                        <tr role="row" class="odd">
                          <td class="sorting_1">{{ $driver->name }}</td>
                          <td>{{ $driver->email }}</td>
                          <td>{{ $driver->phone }}</td>
                          <td>
                            <a href="drivers/delete/{{$driver->id}}" class="delt-cr" onclick="return confirm('Are you sure you want to delete this driver?')">Delete</a>
                          </td>
                          @endforeach
                          @else
                        <tr>
                          <td colspan="7">No Drivers found</td>
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
</div>
@endsection