@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Customer</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.submit.customer') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Sender Name</label>
                            <input type="text" id="name" name="name" value="" class="form-control" required>
                        </div>

                        <div class="form-group  ">
                                <label for="sender_phone">Sender Phone Number</label>
                                <div class="input-group">
                                    <select id="phone_code" name="phone_code" class="form-select" style="max-width:80px;font-size:12px;">
                                        <option value="">code</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="04">04</option>
                                        <option value="1300">1300</option>
                                        <option value="1800">1800</option>
                                    </select>
                                    <input type="tel" name="phone" id="phone" class="form-control"
                                        placeholder="Enter number" 
                                        value="{{ old('sender_phone') }}" 
                                        inputmode="numeric" 
                                        maxlength="15"
                                        oninput="this.value = this.value.replace(/[^0-9]/g,'');">

                                </div>
                                @error('sender_phone') <small class="text-danger">{{ $message }}</small> @enderror
                                @error('sender_state_code') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                        <div class="form-group">
                            <label for="pickup_address">Pickup Address</label>
                            <input type="text" name="pickup_address" value="" class="form-control text-dark" placeholder="Enter pickup address">
                            @error('pickup_address') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>                       

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection