@extends('Nav')
@section('nav')
<style>
  body {
    font-family: 'Garamond', serif;
    /* remove the extra width of disply */
    overflow-x: hidden;  

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

    .form-control {
      font-size: 1rem;
    }

    .btn {
      font-size: 1rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }

  .contact-form-container {
    margin-top: 5%;
  }
</style>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="images/imges2/i5.png" class="img-fluid" alt="Sample image" style="width:100%;margin-top:-8%;">
                </div>
                <div class="col-xl-5 contact-form-container">
                    <h1 class="fw-bold">Contact Us</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12 col-md-6 mb-4">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                                <span class="text-danger">
                                  @error('first_name') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                                <span class="text-danger">@error('last_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control" name="email" placeholder="xyz@example.com" value="{{ old('email') }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-4">
                            <input type="tel" class="form-control" name="phone" placeholder="+1234567890" value="{{ old('phone') }}">
                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="message" rows="3" placeholder="Message">{{ old('message') }}</textarea>
                            <span class="text-danger">@error('message') {{ $message }} @enderror</span>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem; background-color:#f39c12;">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection