@extends('adminnav')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .btn-edit {
    background-color:black ;
    color: white;
    width: 30%;
}
    </style>
</head>
<body>
    

<br><br><br><br><br>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="profile-card text-center animate__animated animate__fadeInUp">
                    <h2>Update Profile</h2><br>
                    
                    <!-- Display success message if it exists -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('update_profile_admin.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group" style="width:90%; margin-left:20px;">
                            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" placeholder="Username">
                            @error('username')
                                <div class="text-danger" style="margin-left:-66%;">{{ $message }}</div>
                            @enderror
                        </div><br>
                        <div class="form-group" style="width:90%; margin-left:20px;">
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                            @error('email')
                                <div class="text-danger" style="margin-left:-70%;">{{ $message }}</div>
                            @enderror
                        </div><br>
                        <div class="form-group" style="width:90%; margin-left:20px;">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                            @error('password')
                                <div class="text-danger" style="margin-left:-65%;">{{ $message }}</div>
                            @enderror
                        </div><br>
                        <div class="form-group" style="width:90%; margin-left:20px;">
                            <input type="file" id="profile_pic" name="profile_pic" class="form-control">
                            @error('profile_pic')
                                <div class="text-danger" style="margin-left:-70%;">{{ $message }}</div>
                            @enderror
                        </div><br>
                        <img src="images/i12.webp" alt="Profile Picture" style="margin-left:-67%;width:170px;height:170px;"><br>

                        <div class="btn-container">
                            <button type="submit" class="btn btn-edit">Update Profile</button>
                            <button type="submit" class="btn btn-edit">Change Password </button>
                            <!-- <a href="#" class="btn btn-edit">Change Password</a> -->
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
