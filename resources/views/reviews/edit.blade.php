<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Review - CineTrack</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-2xl px-6 py-10">

            <!-- Back to My Reviews -->
            <div class="mb-6">
                <a
                    href="{{ route('my-reviews') }}"
                    class="inline-block rounded-md bg-blue-300 px-5 py-2 hover:bg-green-500"
                >
                    ← Back to My Reviews
                </a>
            </div>

            <hr class="mt-4 mb-4">

            <!-- Page heading -->
            <h1 class="text-center text-2xl font-bold text-green-600 sm:text-3xl">
                Edit Review
            </h1>

            <!-- Movie name -->
            <div class="mt-6">
                <p class="text-lg font-bold text-orange-500">
                    Name of the Movie:
                    <span class="text-black">
                        {{ $review->movie->title }}
                    </span>
                </p>
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

            <!-- Edit form -->
            <form
                method="POST"
                action="{{ route('reviews.update', $review) }}"
                class="mt-8 space-y-6"
            >
                @csrf
                @method('PUT')

                <!-- Rating -->
                <div>
                    <label
                        for="rating"
                        class="mb-1 block font-medium text-slate-700"
                    >
                        Rating
                    </label>

                    <select
                        id="rating"
                        name="rating"
                        required
                        class="w-full rounded-md border border-slate-400 bg-white px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                        @for ($rating = 1; $rating <= 5; $rating++)
                            <option
                                value="{{ $rating }}"
                                {{ old('rating', $review->rating) == $rating ? 'selected' : '' }}
                            >
                                {{ $rating }} out of 5
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Review title -->
                <div>
                    <label
                        for="title"
                        class="mb-1 block font-medium text-slate-700"
                    >
                        Review Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $review->title) }}"
                        placeholder="Enter a title for your review"
                        required
                        class="w-full rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                </div>

                <!-- Review content -->
                <div>
                    <label
                        for="content"
                        class="mb-1 block font-medium text-slate-700"
                    >
                        Review
                    </label>

                    <textarea
                        id="content"
                        name="content"
                        rows="6"
                        placeholder="Write your review..."
                        required
                        class="w-full rounded-md border border-slate-400 px-4 py-3 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >{{ old('content', $review->content) }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-center">

                    <a
                        href="{{ route('my-reviews') }}"
                        class="rounded-md bg-orange-400 px-4 py-1 text-center font-bold text-white hover:bg-blue-500"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-md bg-blue-600 px-4 py-1 font-bold text-white hover:bg-green-500"
                    >
                        Update Review
                    </button>

                </div>

            </form>

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>