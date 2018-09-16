<!DOCTYPE html>
<html>
<head>Welcome aboard</head>
<body>
<h2>Welcome to swappit {{$user->name}}</h2>
<p>Your email is : {{$user->email}}</p>
<p>Please click on the following link to activate:</p>
<a href="{{url('user/verify', $user->verifyUser->token)}}">Verify Email</a>
</body>
</html>