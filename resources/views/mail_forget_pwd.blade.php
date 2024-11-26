<!DOCTYPE html>
<html>
<head>
    <title>Password Reset OTP</title>
</head>
<body>
    <h1>Hello, {{ $data3['name'] }}</h1>
    <p>Your OTP for password reset is: <strong>{{ $data3['otp'] }}</strong></p>
    <p>Use this OTP to verify your identity and set a new password.</p>
    <p>Thank you!</p>
</body>
</html>
