<!DOCTYPE html>
<html>
<head>
    <title>Booking Form</title>
             <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Simple Booking Form</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <form id="booking-form" action="{{ route('booking.store') }}" method="POST">
        @csrf

        <!-- Sender's Name -->
        <div class="mb-3">
            <input type="text" name="sender_name" class="form-control" placeholder="Sender's Name" value="{{ old('sender_name') }}">
            @error('sender_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Pickup Address -->
        <div class="mb-3">
            <textarea name="pickup_address" class="form-control" placeholder="Pickup Address">{{ old('pickup_address') }}</textarea>
            @error('pickup_address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Recipient's Name -->
        <div class="mb-3">
            <input type="text" name="recipient_name" class="form-control" placeholder="Recipient's Name" value="{{ old('recipient_name') }}">
            @error('recipient_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Delivery Address -->
        <div class="mb-3">
            <textarea name="delivery_address" class="form-control" placeholder="Delivery Address">{{ old('delivery_address') }}</textarea>
            @error('delivery_address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Recipient Phone -->
        <div class="mb-3">
            <input type="number" name="recipient_phone" class="form-control" placeholder="Recipient Phone" value="{{ old('recipient_phone') }}">
            @error('recipient_phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Delivery Notes -->
        <div class="mb-3">
            <textarea name="delivery_notes" class="form-control" placeholder="Delivery Notes">{{ old('delivery_notes') }}</textarea>
            @error('delivery_notes') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    <!-- Delivery Type -->
        <div class="mb-3">
            <select name="delivery_type" class="form-control">
                <option value="">Select Delivery Type</option>
                <option value="Same Day" {{ old('delivery_type') == 'Same Day' ? 'selected' : '' }}>Same Day</option>
                <option value="Overnight" {{ old('delivery_type') == 'Overnight' ? 'selected' : '' }}>Overnight</option>
            </select>
            @error('delivery_type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <!-- Item Type -->
        <div class="mb-3">
            <select name="item_type" id="item_type" class="form-control" onchange="updatePrice()">
                <option value="">Select Item Size</option>
                <option value="Small" {{ old('item_type') == 'Small' ? 'selected' : '' }}>Small</option>
                <option value="Medium" {{ old('item_type') == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Large" {{ old('item_type') == 'Large' ? 'selected' : '' }}>Large</option>
            </select>
            @error('item_type') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Number of Items -->
        <div class="mb-3">
            <input type="number" name="number_of_items" id="number_of_items" class="form-control" placeholder="Number of Items" value="{{ old('number_of_items') }}" oninput="updatePrice()">
            @error('number_of_items') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <input type="text" id="price" name="price" class="form-control" placeholder="Price" value="{{ old('price') }}">
        </div>

        <!-- Payment Method -->
        <div class="mb-3">
            <label class="form-label">Payment Method</label><br>
            <input type="radio" name="payment_method" id="payment_stripe" value="Stripe" {{ old('payment_method') == 'Stripe' ? 'checked' : '' }}> Stripe
            <input type="radio" name="payment_method" id="payment_cod" value="Cash on Delivery" {{ old('payment_method') == 'Cash on Delivery' ? 'checked' : '' }}> Cash on Delivery
            @error('payment_method') <br><small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Stripe Card Fields -->
        <div id="stripe-fields" style="display:none;">
            <div class="card card-body">
                <h5>Enter Card Details</h5>
                <div id="card-element" class="form-control"></div>
                <div id="card-errors" class="text-danger mt-2"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Booking</button>
    </form>
</div>

<script>
    function updatePrice() {
        let itemType = document.getElementById('item_type').value;
        let numberOfItems = document.getElementById('number_of_items').value || 1;
        let priceField = document.getElementById('price');
        let price = 0;

        if (itemType === 'Small') price = 100;
        else if (itemType === 'Medium') price = 200;
        else if (itemType === 'Large') price = 300;

        priceField.value = price * numberOfItems;
    }

    document.addEventListener('DOMContentLoaded', () => {
        updatePrice();
    });

    const stripe = Stripe("{{ env('STRIPE_PUBLISHABLE_KEY') }}");
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    document.getElementById('payment_stripe').addEventListener('change', () => {
        document.getElementById('stripe-fields').style.display = 'block';
    });

    document.getElementById('payment_cod').addEventListener('change', () => {
        document.getElementById('stripe-fields').style.display = 'none';
    });

    const form = document.getElementById('booking-form');
    form.addEventListener('submit', async (e) => {
        updatePrice(); // Ensure price before submit

        if (document.getElementById('payment_stripe').checked) {
            e.preventDefault();
            const {token, error} = await stripe.createToken(card);

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                let hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'stripe_token';
                hidden.value = token.id;
                form.appendChild(hidden);
                form.submit();
            }
        }
    });
</script>

</body>
</html>
