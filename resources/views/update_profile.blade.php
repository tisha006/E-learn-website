@extends('Nav')
@section('nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        body {
            font-family: 'Garamond', serif;
            background-image: url('background.jpg');
            background-size: cover;
            color: #333;
        }
        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s;
        }
        .profile-card img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
        }
        .social-icons a {
            margin: 0 10px;
            color: #f39c12;
            text-decoration: none;
        }
        .social-icons a:hover {
            color: #e67e22;
        }
        @media (max-width: 768px) {
            .profile-card {
                padding: 20px;
            }
            .profile-card img {
                width: 100px;
                height: 100px;
            }
            .btn-container {
                flex-direction: column;
                align-items: center;
            }
            .btn-container .btn-custom {
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }
        }
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }
        .form-group .text-danger {
            position: absolute;
            left: 0;
            bottom: -20px;
            font-size: 0.875rem;
            color: #dc3545;
        }
        .btn-custom {
            background-color: #f39c12;
            color: white;
        }
        .btn-custom:hover {
            background-color: #e67e22;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top:-10%;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="profile-card text-center animate_animated animate_fadeInUp">
                    <h2>Update Profile</h2><br>

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



<!-- update_profile.blade.php -->
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

<form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" placeholder="Name">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="form-group">
        <input type="text" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Email">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="form-group">
        <input type="file" id="Profile_Pic" name="Profile_Pic" class="form-control">
        @error('Profile_Pic')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="btn-container">
        <button type="submit" class="btn btn-custom mt-4">Update Profile</button>
        <a href="{{ route('change_password') }}" class="btn btn-custom" style="margin-top:25px;">Change Password</a>
    </div>


    
</form>



                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
