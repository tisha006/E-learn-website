<style>
    .final {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full viewport height */
    background-color: #f9f9f9; /* Light background color */
    animation: fadeIn 1s ease; /* Fade-in animation */
}

.payment-container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 90%; /* Responsive width */
    max-width: 500px; /* Max width */
    transition: transform 0.2s ease; /* Smooth transform */
}

.payment-container:hover {
    transform: scale(1.02); /* Slight zoom on hover */
}

.payment-details {
    margin-bottom: 20px;
}

.book-image img {
    width: 100%; /* Full width */
    border-radius: 8px;
    margin-bottom: 10px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    display: block;
}

input.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: border-color 0.3s ease; /* Smooth transition */
}

input.form-control:disabled {
    background-color: #f1f1f1; /* Light gray background for disabled inputs */
    color: #666; /* Darker text color for readability */
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

    </style>
<div class="final">
    <div class="payment-container">
        <h1>Payment</h1>

        
        <div class="payment-details">
       

           

            <div class="form-group">
                <label for="plan_name">Plan Name</label>
                <input type="text" class="form-control" id="plan_name" value="{{ session('plan_name') }}" disabled>
            </div>

            <div class="form-group">
                <label for="total1">Net Payable Amount</label>
                <input type="text" class="form-control" id="total1" value="{{ $total }}" disabled>
            </div>

            <!-- <div class="form-group">
                <label for="order_id">Order ID</label>
                <input type="text" class="form-control" id="order_id" value="{{ $order_id }}" disabled>
            </div> -->
        </div>

        <form action="{{ route('payment.callback') }}" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{ session('email') }}"> <!-- Include email -->
    <input type="hidden" name="plan_name" value="{{ session('plan_name') }}"> <!-- Include plan name -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="{{ $api_key }}"
        data-amount="{{ $total * 100 }}"
        data-currency="INR"
        data-order_id="{{ $order_id }}"
        data-buttontext="Pay"
        data-name="VEDA VISHVA"
        data-description="Complete your payment"
        data-prefill.name="{{ session('name') }}"
        data-prefill.email="{{ session('email') }}"
        data-theme.color="#3b5998">
    </script>
</form>


    </div>
</div>