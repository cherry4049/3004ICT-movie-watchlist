<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CineTrack</title>
</head>
<body>

    @include('layouts.navbar')

    <main>

        <h1>Login</h1>

        @if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <div>
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div>
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit">Login</button>
        </form>

        <p>
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </p>

    </main>

    @include('layouts.footer')

</body>
</html>