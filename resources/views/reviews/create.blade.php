<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Review - CineTrack</title>
</head>
<body>

    <h1>Write a Review</h1>

    <h2>{{ $movie->title }}</h2>
    
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reviews.store', $movie) }}">
        @csrf

        <div>
            <label for="rating">Rating</label>
            <select id="rating" name="rating" required>
                <option value="">Select a rating</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div>
            <label for="title">Review Title</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
            >
        </div>

        <div>
            <label for="content">Review</label>
            <textarea
                id="content"
                name="content"
                required
            >{{ old('content') }}</textarea>
        </div>

        <button type="submit">Submit Review</button>
    </form>

    <a href="{{ url('/movies/' . $movie->id) }}">Back to Movie</a>

</body>
</html>