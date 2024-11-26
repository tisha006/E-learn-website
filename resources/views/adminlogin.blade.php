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
    <section class="vh-100" style="margin-top:14%; margin-bottom:-20%;">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('images/i5.jpg') }}" class="img-fluid" alt="Sample image" style="width:100%;height:100% margin-top:-8%;">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign In As Admin</p>
                    <form action="{{ route('adminlogin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"  placeholder="Enter your email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
                        <div class="form-group">
                       
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
                        <div class="d-flex justify-content-between align-items-center">
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <p class="small" style="color:gray;">Don't have an account? <a href="{{ route('register_admin') }}" class="link-danger" style="color:#f39c12;">Sign Up</a></p>
                            <button type="submit" class="btn" style="background-color:#f39c12; padding-left:2.5rem; padding-right:2.5rem;">Login</button>
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
