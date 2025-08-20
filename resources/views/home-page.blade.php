@extends('layouts.master')

@section('content')
<section class="hero" id="for-business">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="text-start ">Book a Pickup in <span style="color:#ff7a00">Seconds!</span></h1>
                <p>Simple, fast, and mobile-friendly parcel booking. Same Day or Overnight delivery, without the hassle.</p>
                <div class="partner-logos text-center mt-4">
                    <div class="d-flex justify-content-start align-items-center" style="height:100px;">
                        <img src="{{ url('public/images/4.png') }}" alt="Alok Industries Limited" style="height:100px; width: 500px;">
                    </div>
                    <h5 class="fw-bold mt-5 text-start" style="color: white;text-decoration: underline;text-decoration-thickness: 0.2px;text-decoration-color: #878fa0;">
                        Organic Certified and Conventional Fabrics
                    </h5>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="booking-form">
                    <h5 class="fw-bold mb-3 text-dark text-center">Instant Quote. Book Now and Save!</h5>
                    <form id="booking-form" action="{{ route('store.booking') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label text-dark small fw-bold">Sender's Name</label>
                                <input type="text" name="sender_name" class="form-control" placeholder="Sender's Name" value="{{ old('sender_name') }}">
                                @error('sender_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label class="form-label text-dark small fw-bold">Sender Phone Number</label>
                                <input type="tel" name="sender_phone" class="form-control"
                                    placeholder="+61412345678"
                                    value="{{ old('sender_phone') }}"
                                    inputmode="numeric"
                                    maxlength="12"
                                    oninput="this.value=this.value.replace(/(?!^)\+/g,'').replace(/[^0-9+]/g,'')"
                                    title="Please enter a valid 10-digit phone number">
                                @error('sender_phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label text-dark small fw-bold">Pickup Address</label>
                                <input type="text" name="pickup_address" value="{{ old('pickup_address') }}" class="form-control text-dark" placeholder="Enter pickup address">
                                @error('pickup_address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label class="form-label text-dark small fw-bold">Delivery Address</label>
                                <input type="text" name="delivery_address" value="{{ old('delivery_address') }}" class="form-control text-dark" placeholder="Enter delivery address">
                                @error('delivery_address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col">
                                <label class="form-label text-dark small fw-bold">Recipient's Name</label>
                                <input type="text" name="recipient_name" class="form-control" placeholder="Recipient's Name" value="{{ old('recipient_name') }}">
                                @error('recipient_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label class="form-label text-dark small fw-bold">Recipient's Phone</label>
                                <input type="tel" name="recipient_phone" class="form-control"
                                    placeholder="+61412345678"
                                    value="{{ old('recipient_phone') }}"
                                    inputmode="numeric"
                                    maxlength="12"
                                    oninput="this.value=this.value.replace(/(?!^)\+/g,'').replace(/[^0-9+]/g,'')"
                                    title="Please enter a valid 10-digit phone number">
                                @error('recipient_phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold">Delivery Note</label>
                            <textarea name="delivery_notes" class="form-control" placeholder="Delivery Notes">{{ old('delivery_notes') }}</textarea>
                            @error('delivery_notes') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold">Select package style</label>
                            <div class="container py-3">
                                <div class="row g-2 mb-2 align-items-center text-dark">
                                    <div class="col-8">
                                        <select name="item_type[]" class="form-select text-dark bform" id="packageSelect">
                                            <option value="">Select package style</option>
                                            <option value="400">Skid / $400 AUD</option>
                                            <option value="350">Pallet / $350 AUD</option>
                                            <option value="45">Tube / $45 AUD</option>
                                            <option value="45">Crate / $45 AUD</option>
                                            <option value="40">Satchel / $40 AUD</option>
                                            <option value="35">Bag / $35 AUD</option>
                                            <option value="30">Envelope / $30 AUD</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" id="addPackageBtn" class="btn btn-primary w-100">Add Package</button>
                                    </div>
                                </div>
                                <div id="packageList"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold">Choose payment method</label>
                            <div>
                                <!-- Stripe Option -->
                                <label class="text-dark small" for="payment_stripe">Stripe</label>
                                <input type="radio" name="payment_method" id="payment_stripe" value="Stripe"
                                    {{ old('payment_method') == 'Stripe' ? 'checked' : '' }}>

                                <div id="stripe-card-section" style="display:none;">
                                    <div id="card-element" class="form-control mb-3"></div>
                                    <div id="card-errors" role="alert" class="text-danger small mt-1"></div>
                                </div>

                                <!-- COD Option -->
                                <label class="text-dark small" for="payment_cod">Cash on Delivery</label>
                                <input type="radio" name="payment_method" id="payment_cod" value="Cash on Delivery"
                                    {{ old('payment_method') == 'Cash on Delivery' ? 'checked' : '' }}>

                                @error('payment_method')
                                <br><small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div id="totalPrice" class="mb-3 fw-bold text-dark">Total Price: $0</div>
                        <input type="hidden" name="stripe_token" id="stripe_token">
                        <button type="submit" class="btn btn-orange w-100">Submit Booking</button>

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Send Parcels Section -->
<section class="py-5" style="background-color: #062754; color: #FFFFFF;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image -->
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ url('public/images/banner.png') }}" class="img-fluid rounded" alt="Parcel Delivery">
            </div>

            <!-- Text Content -->
            <div class="col-md-6">
                <!-- Orange Tag -->
                <span class="badge px-3 py-2 mb-3 rounded-0" style="background-color: #F68622; font-size: 0.9rem;">
                    How It Works
                </span>

                <!-- Heading -->
                <h3>
                    Send Parcels in Minutes –<br> No Sign-Up, No Delay
                </h3>

                <!-- Paragraph -->
                <p class="mt-4 mb-5 lh-lg" style="color: #E8E9ED;">
                    Booking a delivery with RR Logistic is quick, easy, and mobile-friendly. Simply provide pickup and drop-off details, select the item type and delivery speed, and you're done. We’ll pick it up, deliver it safely, and you don’t even need an account.
                </p>

                <!-- Feature List -->
                <div class="row mt-4">
                    <div class="col-sm-6 mb-3">
                        <img src="{{ url('public/images/icon.svg') }}" alt="Booking Icon" width="24" height="24" class="me-2">
                        <strong>Fill the Booking Form</strong>
                        <p class="small mt-3  fw-light">Enter sender and recipient details, delivery type, and item info.</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <img src="{{ url('public/images/icon1.svg') }}" alt="Booking Icon" width="24" height="24" class="me-2">
                        <strong>Choose Your Price Option</strong>
                        <p class="small  mt-3 fw-light">Pick from 6 fixed pricing tiers based on your item type.</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <img src="{{ url('public/images/icon2.svg') }}" alt="Booking Icon" width="24" height="24" class="me-2">
                        <strong>Choose Payment Method</strong>
                        <p class="small mt-3  fw-light">Pay with PayPal or select Cash on Delivery.</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <img src="{{ url('public/images/icon3.svg') }}" alt="Booking Icon" width="24" height="24" class="me-2">
                        <strong>Submit &amp; Done</strong>
                        <p class="small mt-3  fw-light">We’ll take care of the rest! Your delivery details are sent directly to our dispatch team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Our Services -->
<section class="services py-5" style="background-color: #062754;">
    <div class="container">
        <h3 class="fw-bold text-center" style="font-size: 48px; line-height:52px;">Our Services</h3>
        <p class="text-center text-white mb-5">Simple, fast, and reliable delivery services</p>
        <div class="row g-4">
            <!-- Service Item -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-card">
                    <img src="{{ url('public/images/service.jpg') }}" alt="Parcel Delivery">
                    <div class="overlay text-center">
                        <h5>Parcel Delivery</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-card">
                    <img src="{{ url('public/images/same.jpg') }}" alt="Same Day Delivery">
                    <div class="overlay text-center">
                        <h5>Same Day Delivery</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-card">
                    <img src="{{ url('public/images/overnight.jpg') }}" alt="Overnight Delivery">
                    <div class="overlay text-center">
                        <h5>Overnight Delivery</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-card">
                    <img src="{{ url('public/images/doortodoor.jpg') }}" alt="Door-to-Door Pickup">
                    <div class="overlay text-center">
                        <h5>Door-to-Door Pickup</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-card">
                    <img src="{{ url('public/images/flexible.jpg') }}" alt="Flexible Payment Options">
                    <div class="overlay text-center">
                        <h5>Flexible Payment Options</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-card">
                    <img src="{{ url('public/images/simple.jpg') }}" alt="Simple Booking">
                    <div class="overlay text-center">
                        <h5>Simple Booking</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-card">
                    <img src="{{ url('public/images/safe.jpg') }}" alt="Safe & Secure Handling">
                    <div class="overlay text-center">
                        <h5>Safe & Secure Handling</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-card">
                    <img src="{{ url('public/images/printable.jpg' ) }}" alt="Printable Invoices">
                    <div class="overlay text-center">
                        <h5>Printable Invoices</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection