<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie - CineTrack</title>

    @vite('resources/css/app.css')
</head>
<body>

    @include('layouts.navbar')

    <main>

        <p>
            <a href="{{ route('admin.movies.index') }}">
                ← Back to Movie Management
            </a>
        </p>

        <h1>Add Movie</h1>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.movies.store') }}" enctype="multipart/form-data">

            @csrf

            <div>
                <label for="title">Movie Name</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter movie name"
                    required
                >
            </div>

            <div>
                <label for="release_year">Release Year</label>
                <input
                    type="number"
                    id="release_year"
                    name="release_year"
                    value="{{ old('release_year') }}"
                    placeholder="Enter release year"
                    required
                >
            </div>

            <div>
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    placeholder="Enter movie description"
                    required
                >{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="poster">Movie Poster</label>
                <input
                    type="file"
                    id="poster"
                    name="poster"
                    accept="image/jpeg,image/png,image/gif"
                >

                <p>
                    Upload a JPEG, PNG, or GIF image. Maximum file size: 2 MB.
                </p>
                
            </div>

            <div>
                <label for="genres">Genres</label>

                @foreach ($genres as $genre)
                    <div>
                        <input
                            type="checkbox"
                            id="genre_{{ $genre->id }}"
                            name="genres[]"
                            value="{{ $genre->id }}"
                            {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}
                        >

                        <label for="genre_{{ $genre->id }}">
                            {{ $genre->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div>
                <a href="{{ route('admin.movies.index') }}">
                    <button type="submit">
                        Add Movie
                    </button>
                </a>
                <a href="{{ route('admin.movies.index') }}">
                    Cancel
                </a>
            </div>

        </form>

    </main>

    @include('layouts.footer')

</body>
</html>