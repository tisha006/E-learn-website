@extends('adminnav')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>


<body> 
<br><br><br><br><br><br> <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="profile-card text-center animate__animated animate__fadeInUp">
                    <img src="images/i12.webp" alt="Profile Picture" style="width:170px;height:170px;">
                    <h2>{{ $user->name }}</h2>
                    
                    <hr>
                    
                    <h4>Info</h4>
                    <p>Email: {{ $user->email }}</p>
                    <p>Phone: +1234567890</p>
                     <br><button type="submit" >
                    <a href="{{ route('update_profile_admin') }}" class="btn "style="color: #DEAD37;">Edit Profile</a>
                 </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@endsection

