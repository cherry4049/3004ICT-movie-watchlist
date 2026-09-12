<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CineTrack</title>
</head>
<body>

    @include('layouts.navbar')

    <main>

        <h1>Welcome to CineTrack</h1>

        <p>
            Discover movies. Read reviews.
        </p>

        <p>
            Login or create an account to share your opinion.
        </p>

        <section>
            <h2>Featured / Recent Movies</h2>
        
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

        <p>
            <a href="{{ route('movies.index') }}">
                Browse Movies
            </a>
        </p>

    </main>

    @include('layouts.footer')

</body>
</html>