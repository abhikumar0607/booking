@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Package</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update.package', $package->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Package Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $package->name) }}">
                        </div>   

                        <div class="form-group">
                            <label for="price">Package Price</label>
                            <input type="text" name="price" class="form-control" value="{{ old('price', $package->price) }}">
                        </div>                    

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $package->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $package->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
