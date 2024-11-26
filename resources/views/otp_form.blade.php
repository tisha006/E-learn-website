@extends('Nav')
@section('nav')
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                otp: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                    digits: true,
                },
            },
            messages: {
                otp: {
                    required: "Please enter OTP",
                    minlength: "OTP should be 6 digits",
                    maxlength: "OTP should be 6 digits",
                    digits: "OTP should only contain digits"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });
    });
</script>


<div class="container">
    <h2>Enter OTP</h2>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="form1" action="{{ URL::to('/verify-otp')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="otp">OTP:</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
        </div>
        <button type="submit" class="btn"style="background-color:#f39c12;color:white;">Verify OTP</button>
    </form>
</div>
@endsection
