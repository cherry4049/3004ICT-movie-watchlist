<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CineTrack</title>
</head>
<body>

    @include('layouts.navbar')

    <main>

        <h1>Create Account</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your name"
                    required
                >
            </div>

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

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    required
                >
            </div>

            <button type="submit">Register</button>
        </form>

        <p>
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </p>

    </main>

    @include('layouts.footer')

</body>
</html>