<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review - CineTrack</title>
</head>
<body>

    @include('layouts.navbar')

    <main>

        <p>
            <a href="{{ route('my-reviews') }}">
                ← Back to My Reviews
            </a>
        </p>

        <h1>Edit Review</h1>

        <h2>{{ $review->movie->title }}</h2>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('reviews.update', $review) }}">

            @csrf
            @method('PUT')

            <div>
                <label for="rating">Rating</label>

                <select id="rating" name="rating" required>
                    <option value="">Select a rating</option>
                    <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4</option>
                    <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5</option>
                </select>
            </div>

            <div>
                <label for="title">Review Title</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $review->title) }}"
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
                >{{ old('content', $review->content) }}</textarea>
            </div>

            <div>
                <button type="submit">Save Changes</button>

                <a href="{{ route('my-reviews') }}">
                    Cancel
                </a>
            </div>

        </form>

    </main>

    @include('layouts.footer')

</body>
</html>