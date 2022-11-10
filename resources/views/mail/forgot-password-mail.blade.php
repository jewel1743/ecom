<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
</head>
<body>
    <h5>Dear {{ $data['name'] }}</h5>
    <p>Your New Password Is : {{ $data['new_password'] }}</p>
    <a href="{{ url('/login-register') }}">Login</a>
    <small>
        Thanks.
    </small>
</body>
</html>
