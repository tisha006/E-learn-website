@extends('Nav')

@section('nav')
<div class="container">
    <h2>Forgot Password</h2>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <button type="submit" class="btn "style="background-color:#f39c12;color:white;">Send OTP</button>
    </form>
</div>
@endsection
