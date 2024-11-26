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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('role').addEventListener('change', function () {
        console.log('Role selected:', this.value);
        if (this.value === 'admin') {
            console.log('Redirecting to admin login...');
            window.location.href = '{{ route('adminlogin') }}';
        } else {
            console.log('Redirecting to user login...');
            window.location.href = '{{ route('Login') }}';
        }
    });
});
</script>
<body>

    <section class="vh-100" style="margin-top:-12%;margin-bottom:-20%;margin-left:-10%;">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <br><br><br><img src="images/imges2/i5.png" class="img-fluid" alt="Sample image" style="width:100%;margin-top:-8%;">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                @if(session('message'))
        <script>
            window.onload = function() {
                alert("{{ session('message') }}");
            };
        </script>
    @endif
                    <!-- Display Success or Error Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        };
    </script>
@endif      

                    <form method="POST" action="{{ route('Login') }}">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="text" id="email" name="email" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" value="{{ old('email') }}" />
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ URL::to('/ForgotPassword')}}" class="text-body" style="text-decoration:none;color:#f39c12;">Forgot password?</a>
                        </div>
                        <label for="role">Role:</label>
                        <select name="role" id="role" required>
                            <option value="user">User</option>
                             <option value="admin">Admin</option>
                        </select>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <p class="small" style="margin-top:10px;color:gray;">Don't have an account? <a href="{{ URL::to('/Register') }}"
                                class="link-danger" style="color:#f39c12;">Sign Up</a></p>
                            <button type="submit" class="btn btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:#f39c12;">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><br><br><br><br>

</body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection
            