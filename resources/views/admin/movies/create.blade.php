<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Movie - CineTrack</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-2xl px-6 py-10">

            <!-- Back to Movie Management -->
            <div class="mb-6">
                <a
                    href="{{ route('admin.movies.index') }}"
                    class="inline-block rounded-md bg-blue-300 px-4 py-1 font-bold hover:bg-green-500"
                >
                    ← Back to Movie Management
                </a>
            </div>

            <hr class="mt-4 border-slate-300">

            <!-- Page heading -->
            <h1 class="mt-4 text-center text-2xl font-bold text-green-600 sm:text-3xl">
                Add Movie
            </h1>

            <!-- TMDB movie search -->
            <div class="mt-8 rounded-md border border-blue-300 bg-blue-50 p-5">
               
                <h2 class="text-lg font-bold text-blue-700">
                    Search TMDB
                </h2>

                <p class="mt-1 text-sm text-slate-600">
                    Search TMDB to find movie information and use it to fill the Add Movie form.
                </p>

                <form
                    method="GET"
                    action="{{ route('admin.movies.create') }}"
                    class="mt-4 flex flex-col gap-3 sm:flex-row"
                >
                    <input
                        type="text"
                        name="tmdb_search"
                        value="{{ request('tmdb_search') }}"
                        placeholder="Enter movie title"
                        required
                        class="flex-1 rounded-md border border-slate-400 bg-white px-3 py-1 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus-ring-blue-200"
                    >

                    <button
                        type="submit"
                        class="rounded-md bg-blue-600 px-3 py-1 font-bold text-white hover:bg-green-500"
                    >
                        Search TMDB
                    </button>
                </form>

                @if (request('tmdb_search') && empty($tmdbResults))
                    <p class="mt-4 text-red-600">
                        No movie found.
                    </p>
                @endif

                @if (!empty($tmdbResults))
                    <div class="mt-4 space-y-3">
                        <h3 class="font-bold text-pink-500">
                            Search Results
                        </h3>
                        
                        @foreach ($tmdbResults as $result)
                            <div class="flex items-center gap-4 rounded-md border border-slate-300 bg-white p3 px-2">

                                @if (!empty($result['poster_path']))
                                    <img
                                        src="https://image.tmdb.org/t/p/w92{{ $result['poster_path'] }}"
                                        alt="{{ $result['title'] }} poster"
                                        class="h-20 w-14 py-1 object-cover"
                                    >
                                    @endif

                                    <div class="flex-1">
                                        <p class="font-bold text-slate-800">
                                            {{ $result['title'] }}
                                        </p>

                                        @if (!empty($result['release_date'] ))
                                            <p class="text-sm text-slate-600">
                                                {{ substr($result['release_date'], 0, 4) }}
                                            </p>
                                        @endif
                                    </div>

                                    <button
                                        type="button"
                                        onclick="selectTmdbMovie(
                                            {{ \Illuminate\Support\Js::from($result['title']) }},
                                            {{ \Illuminate\Support\Js::from($result['overview'] ?? '') }},
                                            {{ \Illuminate\Support\Js::from(!empty($result['release_date']) ? substr($result['release_date'], 0, 4) : '') }},
                                            {{ \Illuminate\Support\Js::from($result['genre_ids'] ?? []) }},
                                            {{ \Illuminate\Support\Js::from($result['poster_path'] ?? '') }}
                                        )"
                                        class="rounded-md bg-green-500 px-3 py-1 font-bold text-white hover:bg-blue-600"
                                    >
                                        Select
                                    </button>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>             

            <!-- Validation errors -->
            @if ($errors->any())
                <div class="mt-6 rounded-md border border-red-600 bg-red-50 px-4 py-3 text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Add movie form -->
            <div class="mt-8 rounded-md border border-blue-300 bg-blue-100 p-5">
                <form
                    method="POST"
                    action="{{ route('admin.movies.store') }}"
                    enctype="multipart/form-data"
                    class="mt-8 space-y-6"
                >

                    @csrf

                    <!-- hidden poster field for TMDB poster image download -->
                    <input
                        type="hidden"
                        id="tmdb_poster_path"
                        name="tmdb_poster_path"
                        value=""
                    >

                    <!-- Movie title -->
                    <div>
                        <label
                            for="title"
                            class="mb-1 block font-bold text-slate-700"
                        >
                            Movie Name
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Enter movie name"
                            required
                            class="w-full bg-white rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                    </div>

                    <!-- Release year -->
                    <div>
                        <label
                            for="release_year"
                            class="mb-1 block font-bold text-slate-700"
                        >
                            Release Year
                        </label>

                        <input
                            type="number"
                            id="release_year"
                            name="release_year"
                            value="{{ old('release_year') }}"
                            placeholder="Enter release year"
                            min="1900"
                            max="{{ date('Y') }}"
                            required
                            class="w-full bg-white rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                    </div>

                    <!-- Description -->
                    <div>
                        <label
                            for="description"
                            class="mb-1 block font-bold text-slate-700"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            placeholder="Enter movie description"
                            required
                            class="w-full bg-white rounded-md border border-slate-400 px-4 py-3 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >{{ old('description') }}</textarea>
                    </div>

                    <!-- Poster -->
                    <div>
                        <label
                            for="poster"
                            class="mb-1 block font-bold text-slate-700"
                        >
                            Movie Poster
                        </label>

                        <input
                            type="file"
                            id="poster"
                            name="poster"
                            accept="image/jpeg,image/png,image/gif"
                            class="block w-full rounded-md border border-slate-400 bg-white px-3 py-1 text-slate-900 file:mr-4 file:rounded-md file:border-0 file:bg-green-500 file:px-3 file:py-1 file:text-white hover:file:bg-blue-400"
                        >

                        <p class="mt-1 text-sm text-slate-600">
                            Upload a JPEG, PNG, or GIF image. Maximum file size: 2 MB.
                        </p>
                    </div>

                    <!-- Genres -->
                    <div>
                        <p class="mb-2 font-bold text-slate-700">
                            Genres
                        </p>

                        <div class="space-y-2">
                            @foreach ($genres as $genre)
                                <div class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        id="genre_{{ $genre->id }}"
                                        name="genres[]"
                                        value="{{ $genre->id }}"
                                        {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}
                                        class="h-4 w-4"
                                    >

                                    <label
                                        for="genre_{{ $genre->id }}"
                                        class="text-slate-700"
                                    >
                                        {{ $genre->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col-reverse gap-5 sm:flex-row sm:justify-center">

                        <a
                            href="{{ route('admin.movies.index') }}"
                            class="rounded-md bg-orange-400 px-4 py-1 text-center font-bold text-slate-700 hover:bg-yellow-400"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-md bg-blue-600 px-4 py-1 font-bold text-white hover:bg-green-500"
                        >
                            Add Movie
                        </button>

                </form>
            </div>

        </section>

    </main>

    @include('layouts.footer')

    <script>
        function selectTmdbMovie(title, description, releaseYear, tmdbGenreIds, posterPath) {

            console.log('TMDB genre IDs:', tmdbGenreIds);

            document.getElementById('title').value = title;
            document.getElementById('description').value = description;
            document.getElementById('release_year').value = releaseYear;
            document.getElementById('tmdb_poster_path').value = posterPath;
            
            <!-- map TMBD genris id to CineTrack genris -->
            const genreMap = {
                28: 'Action',
                12: 'Adventure',
                18: 'Drama',
                878: 'Science Fiction',
                53: 'Thriller'
            };

            const hasOtherGenre = tmdbGenreIds.some(function (id) {
                return !genreMap[id];
            });
    
            document.querySelectorAll('input[name="genres[]"]').forEach(function (checkbox) {
                checkbox.checked = false;
    
                const label = document.querySelector(
                    'label[for="' + checkbox.id + '"]'
                );

                if (!label) {
                    return;
                }

                const genreName = label.textContent.trim();
    
                if (tmdbGenreIds.some(function (id) {
                    return genreMap[id] === genreName;
                })) {
                    checkbox.checked = true;
                }

                if (genreName === 'Other' && hasOtherGenre) {
                    checkbox.checked = true;
                }
            });
        }
    </script>

</body>
</html>