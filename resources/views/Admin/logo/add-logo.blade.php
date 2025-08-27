@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Logos</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.submit.logo') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-control" for="logo">Choose Image</label>
                            <input type="file" name="logo" class="form-control" id="logo">
                        </div>                       
                       
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection