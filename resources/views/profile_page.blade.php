@extends('Nav')
@section('nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        .edit-profile-btn {
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .profile-card {
                padding: 20px;
            }
            .profile-card img {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 10%;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="profile-card text-center animate__animated animate__fadeInUp">
                    @if(empty($user->Profile_Pic))
                        <img src="{{ URL::to('/images/profile.png') }}" alt="Profile Picture">
                    @else
                        <img src="{{ URL::to('/images/' . $user->Profile_Pic) }}" alt="Profile Picture">
                    @endif

                    <!-- Displaying values from the Reg table -->
                    <h3>{{ $user->name }}</h3>
                    <p>Email: {{ $user->email }}</p>
                    
                    <a href="{{ URL::to('/update-profile') }}" class="btn" style="background-color: #f39c12; width: 30%; color: white;">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection