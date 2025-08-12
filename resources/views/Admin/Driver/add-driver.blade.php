@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Drivers</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.driver.submit.driver') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" id="name" name="name" value="" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" id="email" name="email" value="" class="form-control" required>
                     @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>  
                  <div class="form-group">
                     <label for="last_name">Phone Number</label>
                     <input type="text" id="phone" name="phone" value="" class="form-control" required>
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