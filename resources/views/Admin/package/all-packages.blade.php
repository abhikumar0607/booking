@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">All Packages</h4>
                <a href="{{ url('admin/add-package') }}" class="btn btn-primary">Add Package</a>
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
                                                    style="width: 242.688px;">Package Name</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Package Price</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 242.688px;">Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($packages) >= 1)
                                            @foreach($packages as $package)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td class="sorting_1">{{ $package->name }}</td>
                                                <td class="sorting_1">{{ $package->price }}</td>
                                                <td>{{ $package->status }}</td>
                                                <td>
                                                    <a href="package/delete/{{$package->id}}" class="delt-cr" onclick="return confirm('Are you sure you want to delete this driver?')" >Delete</a> |
                                                    <a href="package/edit/{{$package->id}}" class="edit-cr" >Edit</a>
                                                </td>
                                                @endforeach
                                                @else
                                            <tr>
                                                <td colspan="7">No Logos found</td>
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