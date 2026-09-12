<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - CineTrack</title>
</head>
<body>

    <h1>Browse Movies</h1>

    @if ($movies->isEmpty())
        <p>No movies are available yet.</p>
    @else
        @foreach ($movies as $movie)
            <div>

                @if ($movie->poster)
                    <img
                        src="{{ asset('images/' . $movie->poster) }}"
                        alt="{{ $movie->title }} poster"
                        width="200"
                    >
                @endif
                
                <h2>{{ $movie->title }}</h2>

                <p>{{ $movie->description }}</p>

                <p>Release Year: {{ $movie->release_year }}</p>

                <a href="{{ route('movies.show', $movie) }}">
                    View Details
                </a>
            </div>
        @endforeach
    @endif

    <p>
        <a href="{{ route('home') }}">Back to Home</a>
    </p>

</body>
</html>