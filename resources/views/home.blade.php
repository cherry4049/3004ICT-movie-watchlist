<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineTrack</title>
</head>
<body>

    <h1>Welcome to CineTrack</h1>

    <p>Discover movies. Read reviews. Share your opinion.</p>

    <a href="{{ route('register') }}">Register</a>
    <a href="{{ route('login') }}">Login</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>