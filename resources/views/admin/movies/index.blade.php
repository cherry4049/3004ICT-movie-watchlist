<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Movie Management - CineTrack</title>

    @vite('resources/css/app.css')
</head>
<body>

    @include('layouts.navbar')

    <main>

        <h1>Movie Management</h1>

        <p>
            <a href="{{ route('admin.movies.create') }}">
                + Add Movie
            </a>
        </p>

        @if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        <section>

            <h2>Search movies</h2>

            <form method="GET" action="{{ route('admin.movies.index') }}">

                <label for="search">Search movies</label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Search by title......."
                >

                <button type="submit">
                    Search
                </button>

            </form>

        </section>

        <hr>

        <section>

            <h2>Movie List</h2>

            <table border="1">

                <thead>
                    <tr>
                        <th>Movie Name</th>
                        <th>Year</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($movies as $movie)

                        <tr>

                            <td>
                                {{ $movie->title }}
                            </td>

                            <td>
                                {{ $movie->release_year }}
                            </td>

                            <td>
                                @foreach ($movie->genres as $genre)
                                    {{ $genre->name }}@if (!$loop->last), @endif
                                @endforeach
                            </td>

                            <td>

                                <a href="{{ route('movies.show', $movie) }}"> View
                                </a>

                                <a href="{{ route('admin.movies.edit', $movie) }}">
                                    Edit
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
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>