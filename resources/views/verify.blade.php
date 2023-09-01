<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify Account</title>
</head>

<body style="margin: 100px;">
    <h1>You have requested to verify your account</h1>
    <hr>
    <p>We cannot simply send you your old password. A unique link to reset your
        password has been generated for you. To reset your password, click the
        following link and follow the instructions.</p>
    <h1><a href="http://127.0.0.1:3000/api/user/verify/{{$token}}">Click Here to Reset Password</a></h1>
</body>

</html>