<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CineTrack</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-7xl px-6 py-10">

            <!-- Welcome section -->
            <div>

                <h1 class="text-center text-3xl font-bold text-green-600 sm:text-4xl">
                    @auth
                        Welcome back, {{ auth()->user()->name }}!
                    @else
                        Welcome to CineTrack
                    @endauth
                </h1>

                @if (auth()->check())

                    @if (auth()->user()->role === 'admin')

                        <p class="mt-4 text-left text-base text-slate-700 sm:text-lg">
                            Discover movies, read reviews, and manage the CineTrack movie collection.
                        </p>

                    @else

                        <p class="mt-4 text-left text-base text-slate-700 sm:text-lg">
                            Discover movies, read reviews, and share your opinion.
                        </p>

                    @endif

                @else

                    <p class="mt-4 text-left text-base text-slate-700 sm:text-lg">
                        Discover movies. Read reviews.
                    </p>

                    <p class="mt-2 text-left text-base text-slate-700">
                        Login or create an account to share your opinion.
                    </p>

                @endif

            </div>

            <!-- Browse Movies -->
            <div class="mt-8 text-center">

                <a
                    href="{{ route('movies.index') }}"
                    class="inline-block rounded-md bg-blue-600 px-6 py-3 font-bold text-white hover:bg-green-500 hover:text-black"
                >
                    Browse Movies
                </a>

            </div>

            <hr class="my-10 border-slate-300">

            <!-- Recent Movies -->
            <section>

                <h2 class="text-2xl font-bold text-green-600 sm:text-3xl">
                    Recent Movies
                </h2>

                <p class="mt-3 text-left text-base text-slate-600">
                    This section shows the 9 most recently added movies. Go to "Movies" in the navigation bar or click "Browse Movies" above to view, search, and filter all available movies.
                </p>

                <!-- Movie cards -->
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

            </section>

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>