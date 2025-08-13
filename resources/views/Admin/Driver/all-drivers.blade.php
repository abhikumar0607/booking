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