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
            <form
                method="POST"
                action="{{ route('admin.movies.store') }}"
                enctype="multipart/form-data"
                class="mt-8 space-y-6"
            >

                @csrf

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
                        class="w-full rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
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
                        class="w-full rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
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
                        class="w-full rounded-md border border-slate-400 px-4 py-3 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
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

                </div>

            </form>

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>