<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Movies - CineTrack</title>

    @vite('resources/css/app.css')
</head>
<body>

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-7xl px-6 py-10">
    
            <!-- Page heading -->
            <h1 class="text-center text-2xl font-bold text-blue-600 sm:text-3xl">
                Browse Movies
            </h1>
    
            <!-- Search and filters -->
            <form
                method="GET"
                action="{{ route('movies.index') }}"
                class="mt-8"
            >
    
                <div class="mx-auto max-w-2xl space-y-5">
    
                    <!-- Search by title -->
                    <div>
                        <label
                            for="search"
                            class="mb-1 block font-medium text-slate-700"
                        >
                            Search movies by title
                        </label>
    
                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Title contains..."
                            class="w-full rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                    </div>
    
                    <!-- Genre -->
                    <div>
                        <label
                            for="genre"
                            class="mb-1 block font-medium text-slate-700"
                        >
                            Genre
                        </label>
    
                        <select
                            id="genre"
                            name="genre"
                            class="w-full rounded-md border border-slate-400 bg-white px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                            <option value="">All Genres</option>
    
                            @foreach ($genres as $genreOption)
                                <option
                                    value="{{ $genreOption->id }}"
                                    {{ $genre == $genreOption->id ? 'selected' : '' }}
                                >
                                    {{ $genreOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
                    <!-- Release Year -->
                    <div>
                        <label
                            for="year"
                            class="mb-1 block font-medium text-slate-700"
                        >
                            Release Year
                        </label>
    
                        <select
                            id="year"
                            name="year"
                            class="w-full rounded-md border border-slate-400 bg-white px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                            <option value="">All Years</option>
    
                            @foreach ($years as $yearOption)
                                <option
                                    value="{{ $yearOption->release_year }}"
                                    {{ $year == $yearOption->release_year ? 'selected' : '' }}
                                >
                                    {{ $yearOption->release_year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
                    <!-- Search button -->
                    <div class="text-center">
    
                        <button
                            type="submit"
                            class="rounded-md bg-blue-600 px-6 py-2 font-bold text-white hover:bg-green-500 hover:text-black"
                        >
                            Search
                        </button>
    
                    </div>
    
                </div>
    
            </form>
    
            <hr class="my-10 border-slate-300">
    
            <!-- Movies -->
            <section>
    
                <h2 class="text-2xl font-bold text-green-600 sm:text-3xl">
                    Movies
                </h2>
    
                <!-- Movie cards -->                
                @if ($movies->count())

                    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-3 lg:grid-cols-4">

                        @foreach ($movies as $movie)

                            <article class="flex h-full flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                                <!-- Poster -->
                                <div class="aspect-[1/1] w-full bg-slate-100">

                                    @if ($movie->poster)

                                        <img
                                            src="{{ asset('images/' . $movie->poster) }}"
                                            alt="{{ $movie->title }} poster"
                                            class="h-full w-full object-contain"
                                        >

                                    @else

                                        <div class="flex h-full items-center justify-center text-slate-500">
                                            No poster available
                                        </div>

                                    @endif

                                </div>

                                <!-- Movie information -->
                                <div class="flex flex-1 flex-col p-5">

                                    <h3 class="text-xl font-bold text-slate-900">
                                        {{ $movie->title }}
                                    </h3>

                                    <p class="mt-2 text-slate-600">
                                        {{ $movie->release_year }}
                                    </p>

                                    @if ($movie->reviews_avg_rating)

                                        <p class="mt-2 text-slate-700">
                                            ★ {{ number_format($movie->reviews_avg_rating, 1) }} out of 5
                                        </p>

                                    @else

                                        <p class="mt-2 text-slate-500">
                                            ★ No ratings yet
                                        </p>

                                    @endif

                                    <!-- Details button -->
                                    <div class="mt-auto pt-5">

                                        <a
                                            href="{{ route('movies.show', $movie) }}"
                                            class="inline-block rounded-md bg-blue-600 px-5 py-2 font-bold text-white hover:bg-green-500 hover:text-black"
                                        >
                                            Details
                                        </a>

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    <p class="mt-6 text-slate-600">
                        No matching movies found.
                    </p>

                @endif
    
            </section>
    
        </section>
    
    </main>

    @include('layouts.footer')

</body>
</html>