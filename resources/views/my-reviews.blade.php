<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reviews - CineTrack</title>
</head>
<body>

    @include('layouts.navbar')

    <main>

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
        
                <div>
                    <strong>{{ $review->movie->title }}</strong>
        
                    <span>
                        @for ($i = 1; $i <= 5; $i++)
                            {{ $i <= $review->rating ? '★' : '☆' }}
                        @endfor
                    </span>
                </div>
        
                <p>
                    <strong>{{ $review->title }}</strong>
                </p>
        
                <p>
                    {{ $review->content }}
                </p>
        
                <a href="{{ route('movies.show', $review->movie) }}">
                    <button type="button">View Movie</button>
                </a>
        
                <a href="{{ route('reviews.edit', $review) }}">
                    Edit
                </a>
        
                <form
                    method="POST"
                    action="{{ route('reviews.destroy', $review) }}"
                    style="display: inline;"
                    onsubmit="return confirm('Are you sure you want to delete this review?');"
                >
                    @csrf

                    <!-- tells Laravel to treat thios form submission as a DELETE request -->
                    @method('DELETE')

                    <button type="submit">
                        Delete
                    </button>
                </form>
        
            </div>
        
        @endforeach

        @endif

    </main>

    @include('layouts.footer')

</body>
</html>