@extends('Nav')

@section('nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: 'Garamond', serif;
            background-image: url('background.jpg');
            background-size: cover;
            overflow-x: hidden;
            color: #333;
        }
        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-group {
            position: relative;
            margin-bottom: 15px;
        }
        .form-group input.form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
        .form-group .text-danger {
            position: absolute;
            left: 0;
            top: 100%;
            width: 100%;
            font-size: 0.875rem;
            color: #dc3545;
            margin-top: 0.25rem;
            text-align: left;
        }
        .btn-custom {
            background-color: #f39c12;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #e67e22;
        }
        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .invalid-feedback {
            display: block;
        }
        .error-message {
            color: red;
        }
        /* Specific style for "Old Password" label */
        .old-password-label {
            font-family: 'Cormorant', serif;
            font-weight: 600;
            color: #856a56;
        }

    </style>
</head>
<body>
    <div class="container" style="margin-top:-10%;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="profile-card text-center">
                    <h2>Change Password</h2><br>
        
                    <form action="{{ route('change_password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Old password">
                    @error('password')
                        <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="mb-3">
                    <input type="password" class="form-control" id="n_password" name="n_password" placeholder="New Password">
                    @error('n_password')
                        <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="mb-3">
                    <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Confirm Password">
                    @error('c_password')
                        <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                </div><br>
                <button type="submit" class="btn"style="background-color:#f39c12;">Save Changes</button>
            </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
