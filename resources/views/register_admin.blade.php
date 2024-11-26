@extends('adminnav')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
     
</head>
<body>
    <section class="vh-100" style="margin-top:6%; margin-bottom:-20%;">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('images/i5.jpg') }}" class="img-fluid" alt="Sample image" style="width:900%; margin-top:12%;">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign Up</p>
                    <form action="{{ route('register_admin') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <input type="text" name="name" class="form-control"  value="{{ old('name') }}" placeholder="Enter Your Name"/>
                            @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="mb-4">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Your Email"/>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                             @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat your password"/>
                            @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <p class="small" style="color:gray;">Have an account? <a href="{{ route('login') }}" class="link-danger" style="color:#f39c12;">Sign In</a></p>
                            <button type="submit" class="btn" style="background-color:#f39c12; padding-left:2.5rem; padding-right:2.5rem;">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

@endsection