@extends('Nav')
@section('nav')
    <script>
        $(document).ready(function() {
            $("#form1").validate({
                rules: {
                    pswd: {
                        required: true,
                        minlength: 8,
                        maxlength: 25,
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,25}$/
                    },
                    repswd: {
                        required: true,
                        minlength: 6,
                        equalTo: "#pwd"
                    },
                },
                messages: {
                    pswd: {
                        required: "Please provide a password",
                        minlength: "Password must be at least 8 characters long",
                        maxlength: "Password must not be greater than 25 characters",
                        pattern: "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character"
                    },
                    repswd: {
                        required: "Please confirm your password",
                        minlength: "Password must be at least 6 characters long",
                        equalTo: "Password and Confirm Passwords do not match"
                    },
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
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });
        });
    </script>
   <div class="container">
    <h2>Set New Password</h2>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn"style="background-color:#f39c12;color:white;">Update Password</button>
    </form>
</div>
@endsection