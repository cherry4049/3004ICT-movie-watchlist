<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reviews - CineTrack</title>
</head>
<body>

    <h1>My Reviews</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if ($reviews->isEmpty())
        <p>You have not written any reviews yet.</p>
    @else
        @foreach ($reviews as $review)
            <div>
                <h2>{{ $review->movie->title }}</h2>

                <p>
                    <strong>{{ $review->title }}</strong>
                </p>

                <p>
                    Rating: {{ $review->rating }}/5
                </p>

                <p>{{ $review->content }}</p>

                <a href="{{ route('movies.show', $review->movie) }}">
                    View Movie
                </a>
            </div>
        @endforeach
    @endif

    <p>
        <a href="{{ route('home') }}">Home</a>
    </p>

</body>
</html>