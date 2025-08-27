@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">How It work</h4>
                <a href="{{ url('admin/add-how-it-work') }}" class="btn btn-primary">Add New</a>
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
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>banner Image</th>
                                                <th>Status</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($items) >= 1)
                                            @foreach($items as $item)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $item->title }}</td>
                                                <td class="sorting_1">{{ \Illuminate\Support\Str::limit($item->description, 50) }}</td>
                                                <td><img src="{{ url('public/' . $item->image) }}" alt="banner-image" width="50"></td>                                            
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <a href="how-it-work/delete/{{$item->id}}" class="delt-cr" onclick="return confirm('Are you sure you want to delete this driver?')" >Delete</a>/
                                                    <a href="how-it-work/edit/{{$item->id}}" class="delt-cr">Edit</a>
                                                </td>
                                                @endforeach
                                                @else
                                            <tr>
                                                <td colspan="7">No Record found</td>
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