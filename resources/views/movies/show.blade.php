<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - CineTrack</title>

    @vite('resources/css/app.css')
</head>
<body>

    @include('layouts.navbar')

    <!-- submit review success message -->
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <h1>Movie Details</h1>

    @auth
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.movies.edit', $movie) }}">
                Edit Movie
            </a>

            <form
                method="POST"
                action="{{ route('admin.movies.destroy', $movie) }}"
                style="display: inline;"
                onsubmit="return confirm('Are you sure you want to delete this movie?');"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Delete Movie
                </button>
            </form>
        @endif
    @endauth


    <p>
        <a href="{{ route('movies.index') }}">
            ← Back to Movies
        </a>
    </p>

    <!-- Movie information -->
    <div>

        @if ($movie->poster)
            <img
                src="{{ asset('images/' . $movie->poster) }}"
                alt="{{ $movie->title }} poster"
                width="300"
            >
        @endif

        <div>
            <h2>{{ $movie->title }}</h2>

            <p>
                <strong>Year:</strong>
                {{ $movie->release_year }}
            </p>

            <p>
                <strong>Genres:</strong>
                @foreach ($movie->genres as $genre)
                    {{ $genre->name }}@if (!$loop->last), @endif
                @endforeach
            </p>

            @if (auth()->check())
                <p>
                    <a href="{{ route('reviews.create', $movie) }}">
                        Write a Review
                    </a>
                </p>
            @endif
        </div>

    </div>

    <hr>

    <!-- Description -->
    <h2>Description</h2>

    <p>
        {{ $movie->description }}
    </p>

    <hr>

    <!-- Reviews -->
    <h2>Reviews</h2>

    @if ($movie->reviews->isEmpty())
        <p>No reviews yet.</p>
    @else
        @foreach ($movie->reviews as $review)
            <div>
                <h3>{{ $review->title }}</h3>

                <p>
                    Rating: {{ $review->rating }}/5
                </p>

                <p>{{ $review->content }}</p>

                <p>
                    By {{ $review->user->name }}
                </p>
            </div>
        @endforeach
    @endif

    @include('layouts.footer')
</body>
</html>