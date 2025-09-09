@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">All records</h4>
                <a href="{{ url('admin/add-customer') }}" class="btn btn-primary">Add Customer</a>
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
                                                    style="width: 242.688px;">Customer Number</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Code</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Sender Name</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Sender Phone</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Picup Address</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($customers) >= 1)
                                            @foreach($customers as $customer)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $customer->customer_number }}</td>
                                                <td class="sorting_1">{{ $customer->code }}</td>
                                                <td class="sorting_1">{{ $customer->name }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>{{ $customer->pickup_address }}</td>
                                                <td>
                                                    <a href="customer/delete/{{$customer->id}}" class="delt-cr" onclick="return confirm('Are you sure you want to delete this driver?')" >Delete</a> |
                                                    <a href="customer/edit/{{$customer->id}}" class="delt-cr" >Edit</a>
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
@endsection