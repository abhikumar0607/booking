@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Customer</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update.customer', $customer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Sender Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="sender_phone">Sender Phone Number</label>
                            <div class="input-group">
                                <select id="phone_code" name="phone_code" class="form-select" style="max-width:80px;font-size:12px;">
                                    <option value="">code</option>
                                    <option value="02" {{ $customer->phone_code == '02' ? 'selected' : '' }}>02</option>
                                    <option value="03" {{ $customer->phone_code == '03' ? 'selected' : '' }}>03</option>
                                    <option value="07" {{ $customer->phone_code == '07' ? 'selected' : '' }}>07</option>
                                    <option value="08" {{ $customer->phone_code == '08' ? 'selected' : '' }}>08</option>
                                    <option value="04" {{ $customer->phone_code == '04' ? 'selected' : '' }}>04</option>
                                    <option value="1300" {{ $customer->phone_code == '1300' ? 'selected' : '' }}>1300</option>
                                    <option value="1800" {{ $customer->phone_code == '1800' ? 'selected' : '' }}>1800</option>
                                </select>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                       placeholder="Enter number" 
                                       value="{{ old('phone', $customer->phone) }}" 
                                       inputmode="numeric" 
                                       maxlength="15"
                                       oninput="this.value = this.value.replace(/[^0-9]/g,'');">
                            </div>
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="pickup_address">Pickup Address</label>
                            <input type="text" name="pickup_address" 
                                   value="{{ old('pickup_address', $customer->pickup_address) }}" 
                                   class="form-control text-dark" placeholder="Enter pickup address">
                            @error('pickup_address') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>                       

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
