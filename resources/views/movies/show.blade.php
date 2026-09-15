<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $movie->title }} - CineTrack</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-7xl px-6 py-10">

            <div class="mb-6">
                <a
                    href="{{ route('movies.index') }}"
                    class="inline-block rounded-md bg-blue-300 px-5 py-2 text-white hover:bg-green-500"
                >
                    ← Back to Movies
                </a>
            </div>

            <!-- Page heading -->
            <h1 class="text-center text-2xl font-bold text-green-600 sm:text-3xl">
                Movie Details
            </h1>

            <hr class="mt-4 border-slate-300">

            <!-- Success message -->
            @if (session('success'))
                <div class="mx-auto mt-6 max-w-4xl rounded-md border border-green-600 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Admin actions -->
            @auth
                @if (auth()->user()->role === 'admin')
                    <div class="mt-6 flex flex-wrap justify-end gap-3">

                        <a
                            href="{{ route('admin.movies.edit', $movie) }}"
                            class="rounded-md bg-blue-600 px-4 py-1 font-bold text-white hover:bg-green-500 hover:text-black"
                        >
                            Edit Movie
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.movies.destroy', $movie) }}"
                            onsubmit="return confirm('Are you sure you want to delete this movie?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="rounded-md bg-red-600 px-4 py-1 font-bold text-white hover:bg-yellow-400 hover:text-black"
                            >
                                Delete Movie
                            </button>
                        </form>

                    </div>
                @endif
            @endauth

            <!-- Movie information -->
            <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-3">

                <!-- Poster -->
                <div class="lg:col-span-1">
                    <div class="aspect-[1/1] w-full overflow-hidden rounded-lg border border-slate-200 bg-slate-100 shadow-sm">

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
                </div>

                <!-- Movie details -->
                <div class="lg:col-span-2">

                    <h2 class="text-3xl font-bold text-slate-900">
                        {{ $movie->title }}
                    </h2>

                    <p class="mt-3 text-lg text-slate-600">
                        Release Year: {{ $movie->release_year }}
                    </p>

                    <!-- Genres -->
                    <div class="mt-4">
                        <h3 class="font-bold text-slate-800">
                            Genres
                        </h3>

                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach ($movie->genres as $genre)
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-700">
                                    {{ $genre->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-xl font-bold text-slate-900">
                            Description
                        </h3>

                        <p class="mt-2 leading-7 text-slate-700">
                            {{ $movie->description }}
                        </p>
                    </div>

                    <hr class="mt-4 border-slate-300">
                    
                    <!-- Write review -->
                    @auth
                        <div class="mt-8">
                            <a
                                href="{{ route('reviews.create', $movie) }}"
                                class="inline-block rounded-md bg-blue-600 px-6 py-3 font-bold text-white hover:bg-green-500 hover:text-black"
                            >
                                Write a Review
                            </a>
                        </div>
                    @endauth

                </div>

            </div>
            
            <hr class="mt-4 border-slate-300">

            <!-- Reviews -->
            <section class="mt-5">

                <h2 class="text-2xl font-bold text-green-600 sm:text-3xl">
                    Reviews
                </h2>

                @if ($movie->reviews->count())

                    <div class="mt-6 space-y-6">

                        @foreach ($movie->reviews as $review)
                            <article class="rounded-lg border border-slate-200 bg-white p-6 shadow-md">

                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                                    <h3 class="text-xl font-bold text-slate-900">
                                        {{ $review->title }}
                                    </h3>

                                    <p class="font-medium text-orange-500">
                                        ★ {{ $review->rating }} out of 5
                                    </p>

                                </div>

                                <p class="mt-2 text-sm text-slate-500">
                                    By {{ $review->user->name }}
                                </p>

                                <hr class="mt-4 border-slate-300">

                                <p class="mt-4 leading-7 text-slate-700">
                                    {{ $review->content }}
                                </p>

                            </article>
                        @endforeach

                    </div>

                @else

                    <p class="mt-4 text-slate-600">
                        No reviews yet.
                    </p>

                @endif

            </section>

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>