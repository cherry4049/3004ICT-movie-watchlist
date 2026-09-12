<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Movies - CineTrack</title>
</head>
<body>

    @include('layouts.navbar')

    <main>

        <h1>Browse Movies</h1>

        <form method="GET" action="{{ route('movies.index') }}">

            <div>
                <label for="search">Search movies by title</label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Title contains ..."
                >
            </div>

            <div>
                <label for="genre">Genre</label>

                <select id="genre" name="genre">
                    <option value="">All Genres</option>

                    @foreach ($genres as $item)
                        <option
                            value="{{ $item->id }}"
                            {{ $genre == $item->id ? 'selected' : '' }}
                        >
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="year">Release Year</label>

                <select id="year" name="year">
                    <option value="">All Years</option>

                    @foreach ($years as $item)
                        <option
                            value="{{ $item->release_year }}"
                            {{ $year == $item->release_year ? 'selected' : '' }}
                        >
                            {{ $item->release_year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Search</button>
            
            @if ($filtersUsed && $matchingMovies->isEmpty())
                <p>No matching movies found.</p>
            @endif

        </form>

        <hr>

        <section>

            <h2>Movies</h2>

            @if ($movies->isEmpty())

                <p>No movies match your search or filters.</p>

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

                        <h3>{{ $movie->title }}</h3>

                        <p>{{ $movie->release_year }}</p>

                        @if ($movie->reviews_avg_rating)
                            <p>
                                ★ {{ number_format($movie->reviews_avg_rating, 1) }} out of 5
                            </p>
                        @else
                            <p>★ No ratings yet</p>
                        @endif

                        <a href="{{ route('movies.show', $movie) }}">
                            Details
                        </a>

                    </div>

                @endforeach

            @endif

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>