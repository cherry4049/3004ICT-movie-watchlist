<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CineTrack</title>

    @vite('resources/css/app.css')
</head>
<body>

    @include('layouts.navbar')

    <main>

        <h1>
            @auth
                Welcome back, {{ auth()->user()->name }}!
            @else
                Welcome to CineTrack
            @endauth
        </h1>        

        @if (auth()->check())
            @if (auth()->user()->role === 'admin')
                <p>
                    Discover movies, read reviews, and manage the CineTrack movie collection.
                </p>
            @else
                <p>
                    Discover movies, read reviews, and share your opinion.
                </p>
            @endif

        @else                   
            <p>
                Discover movies. Read reviews.
            </p>

            <p>
                Login or create an account to share your opinion.
            </p>
        @endif

        <hr>

        <section>
            <h2>Recent Movies</h2>
            <p>
                This section shows the 9 most recently added movies. Go to "Movies" in the navigation bar or click "Browse Movies" below to view, search, and filter all available movies.            
             </p>
        
            @foreach ($movies as $movie)
                <div>
                    @if ($movie->poster)
                        <img
                            src="{{ asset('images/' . $movie->poster) }}"
                            alt="{{ $movie->title }} poster"
                            width="200"
                        >
                    @endif
        
                    <h3>{{ $movie->title }}</h3>
        
                    <p>{{ $movie->release_year }}</p>
        
                    @if ($movie->reviews_avg_rating)
                        <p>★ {{ number_format($movie->reviews_avg_rating, 1) }} out of 5</p>
                    @else
                        <p>★ No ratings yet</p>
                    @endif
        
                    <a href="{{ route('movies.show', $movie) }}">
                        Details
                    </a>
                </div>
            @endforeach
        </section>

        <hr>

        <p>
            <a href="{{ route('movies.index') }}">
                Browse Movies
            </a>
        </p>

    </main>

    @include('layouts.footer')

</body>
</html>