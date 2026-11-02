<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>
<body>
    <h1>My Profile</h1>

    <p>Welcome, {{ Auth::user()->name }}!</p>
    <p>Email: {{ Auth::user()->email }}</p>

    <a href="{{ route('home') }}">Back to Home</a>
</body>
</html>