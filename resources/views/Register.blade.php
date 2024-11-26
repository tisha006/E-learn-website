@extends('Nav')
@section('nav')
<style>
  body {
    font-family: 'Garamond', serif;
  }

  .img-fluid {
    max-width: 100%;
    height: auto;
  }

  .vh-100 {
    margin-top: 5%;
    margin-bottom: -5%;
  }

  .container-fluid.h-custom {
    padding-left: 10px;
    padding-right: 10px;
  }

  @media (max-width: 1200px) {
    .container-fluid.h-custom {
      padding-left: 30px;
      padding-right: 30px;
    }
  }

  @media (max-width: 992px) {
    .vh-100 {
      margin-top: 10%;
      margin-bottom: -10%;
    }

    .container-fluid.h-custom {
      padding-left: 20px;
      padding-right: 20px;
    }
  }

  @media (max-width: 768px) {
    .vh-100 {
      margin-top: 5%;
      margin-bottom: -5%;
    }

    .container-fluid.h-custom {
      padding-left: 15px;
      padding-right: 15px;
    }
  }

  @media (max-width: 576px) {
    .vh-100 {
      margin-top: 2%;
      margin-bottom: -2%;
    }

    .container-fluid.h-custom {
      padding-left: 10px;
      padding-right: 10px;
    }

    .h1 {
      font-size: 1.5rem;
    }

    .form-control-lg {
      font-size: 1rem;
    }

    .btn {
      font-size: 1rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }
</style>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="images/imges2/i5.png" class="img-fluid" alt="Sample image" style="width:100%;margin-top:-8%;">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign Up</p>

                    <!-- Display Success or Error Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('Register') }}">
                            @csrf
                            <div class="d-flex flex-row align-items-center mb-4">
                                <!-- <i class="fas fa-user fa-lg me-3 fa-fw"></i> -->
                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}"/>
                                    <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <!-- <i class="fas fa-envelope fa-lg me-3 fa-fw"></i> -->
                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}"/>
                                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <!-- <i class="fas fa-lock fa-lg me-3 fa-fw"></i> -->
                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
                                    <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <!-- <i class="fas fa-key fa-lg me-3 fa-fw"></i> -->
                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repeat your password"/>
                                    <span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>
                                </div>
                            </div>

                         




                        
                           

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <p class="small" style="color:gray;">Have already an account? <a href="{{ URL::to('/Login') }}"
                                    class="link-danger" style="color:#f39c12;">Sign In</a></p>
                                <button type="submit" class="btn" style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:#f39c12;">Register</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </section><br><br><br><br><br><br><br>
</body>
<br><br><br><br><br><br><br>
@endsection