<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .greeting {
            color: red;
        }
    </style>
</head>
<body>
    <p class="greeting">Hello!</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p><a href="{{$link_reset}}">Reset Password</a></p>
    <p>This password reset link will expire in 60 minutes.</p>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Regards,</p>
    <p>{{env('APP_NAME')}}</p>
</body>
</html>

