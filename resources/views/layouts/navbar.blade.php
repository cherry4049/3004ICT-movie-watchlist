<nav>
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="CineTrack" height="50">
    </a>

    <a href="{{ route('home') }}">Home</a>

    <a href="{{ route('movies.index') }}">Movies</a>

    @auth
        <a href="{{ route('my-reviews') }}">My Reviews</a>

        <span>Hi, {{ auth()->user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>