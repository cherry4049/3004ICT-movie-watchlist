<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Reviews - CineTrack</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-5xl px-6 py-10">

            <!-- Page heading -->
            <h1 class="text-center text-2xl font-bold text-green-600 sm:text-3xl">
                My Reviews
            </h1>

            <!-- Success message -->
            @if (session('success'))
                <div class="mt-6 rounded-md border border-green-600 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($reviews->count())

                <!-- Review cards -->
                <div class="mt-8 space-y-4">

                    @foreach ($reviews as $review)
                        <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-md">

                            <!-- Movie name and View Movie -->
                            <div class="flex flex-wrap items-center justify-between">

                                <h2 class="text-xl font-bold text-purple-500">
                                    {{ $review->movie->title }}
                                </h2>

                                <a
                                    href="{{ route('movies.show', $review->movie) }}"
                                    class="rounded-sm bg-blue-200 px-3 py-1 hover:bg-green-500"
                                >
                                    View Movie
                                </a>

                            </div>

                            <hr class="mt-4 border-slate-300">

                            <!-- Rating -->
                            <p class="mt-2 text-lg text-orange-400 text-right">
                                ★ {{ $review->rating }} out of 5
                            </p>

                            <!-- Review title -->
                            <h3 class="mt-2 text-lg font-bold text-slate-800">
                                {{ $review->title }}
                            </h3>

                            <!-- Review content -->
                            <p class="whitespace-pre-line leading-7 text-slate-700">
                                {{ $review->content }}
                            </p>

                            <hr class="mt-4 border-slate-300">

                            <!-- Edit and Delete -->
                            <div class="mt-6 flex items-center justify-center flex-wrap gap-5">

                                <a
                                    href="{{ route('reviews.edit', $review) }}"
                                    class="rounded-md border border-green-600 px-5 py-1 font-bold text-white bg-green-500 hover:bg-blue-500"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('reviews.destroy', $review) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this review?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-md bg-red-600 px-5 py-1 font-bold text-white hover:bg-yellow-400"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </article>
                    @endforeach
                
                </div>

            @else

                <div class="mt-8 rounded-lg border border-slate-200 bg-slate-50 p-8 text-center">
                    <p class="text-slate-600">
                        You have not written any reviews yet.
                    </p>

                    <a
                        href="{{ route('movies.index') }}"
                        class="mt-5 inline-block rounded-md bg-blue-600 px-6 py-3 font-bold text-white hover:bg-green-500 hover:text-black"
                    >
                        Browse Movies
                    </a>
                </div>

            @endif

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>