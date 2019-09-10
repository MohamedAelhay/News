<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$user['fname']}} {{ $user['lname'] }}</h2>
<br/>
Your registered email-id is {{$user['email']}}
</body>

</html>
