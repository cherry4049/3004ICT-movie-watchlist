<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Review - CineTrack</title>

    @vite('resources/css/app.css')
</head>
<body>

    @include('layouts.navbar')

    <main>

        <p>
            <a href="{{ route('movies.index') }}">
                ← Back to Movies
            </a>
        </p>

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
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4</option>
                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5</option>
                </select>
            </div>

            <div>
                <label for="title">Review Title</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter your review title"
                    required
                >
            </div>

            <div>
                <label for="content">Review</label>

                <textarea
                    id="content"
                    name="content"
                    placeholder="Write your review..."
                    required
                >{{ old('content') }}</textarea>
            </div>

            <div>
                <button type="submit">Submit</button>

                <a href="{{ route('movies.show', $movie) }}">
                    Cancel
                </a>
            </div>

        </form>

    </main>

    @include('layouts.footer')

</body>
</html>