<!DOCTYPE html>
<html>
<head>
    <title>Subscription Reminder</title>
</head>
<body>
    <h1>Hello, {{ $user->name ?? 'Subscriber' }}</h1>
    <p>Your subscription for the plan "{{ $user->plan_name ?? 'N/A' }}" is about to expire on {{ \Carbon\Carbon::parse($user->expiration_date)->format('d M Y') }}.</p>
    <p>Please renew your subscription to avoid interruption of service.</p>
    <p>Thank you for being with us!</p>
</body>
</html>
