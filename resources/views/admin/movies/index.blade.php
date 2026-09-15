<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Movie Management - CineTrack</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-7xl px-6 py-10">

            <!-- Page heading and Add Movie -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-center">

                <h1 class="text-2xl font-bold text-green-600 sm:text-3xl">
                    Manage Movies
                </h1>                

            </div>

            <hr class="mt-4 border-slate-300">

            <!-- Success message -->
            @if (session('success'))
                <div class="mt-6 rounded-md border border-green-600 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search -->
            <section class="mt-8">

                <form
                    method="GET"
                    action="{{ route('admin.movies.index') }}"
                    class="mt-4"
                >
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end">

                        <div class="w-full sm:max-w-xl">
                            <label
                                for="search"
                                class="mb-1 px-4 block font-medium text-slate-700"
                            >
                                Search movies
                            </label>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ $search ?? '' }}"
                                placeholder="Search by title......."
                                class="w-full rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            >
                        </div>

                        <button
                            type="submit"
                            class="rounded-md bg-blue-500 px-6 py-2 font-bold text-white hover:bg-green-500"
                        >
                            Search
                        </button>

                    </div>
                </form>

            </section>

            <hr class="my-10 border-slate-300">

            <!-- Movie list -->
            <section>
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    
                    <h2 class="text-xl px-4 font-bold text-purple-500 sm:text-2xl">
                        Movie List
                    </h2>

                    <a
                        href="{{ route('admin.movies.create') }}"
                        class="inline-block rounded-md bg-green-500 px-5 py-2 text-center font-bold text-white hover:bg-blue-500"
                    >
                        + Add Movie
                    </a>

                </div>

                @if ($movies->count())

                    <div class="mt-6 overflow-x-auto rounded-lg border border-slate-200 shadow-sm">

                        <table class="min-w-full bg-white text-left">

                            <thead class="bg-slate-100">
                                <tr>
                                    <th class="px-5 py-4 font-bold text-slate-800">
                                        Movie Name
                                    </th>

                                    <th class="px-5 py-4 font-bold text-slate-800">
                                        Year
                                    </th>

                                    <th class="px-5 py-4 font-bold text-slate-800">
                                        Genre
                                    </th>

                                    <th class="px-5 py-4 font-bold text-slate-800">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200">

                                @foreach ($movies as $movie)
                                    <tr class="hover:bg-slate-50">

                                        <td class="px-4 py-2 font-medium text-slate-900">
                                            {{ $movie->title }}
                                        </td>

                                        <td class="px-4 py-2 text-slate-700">
                                            {{ $movie->release_year }}
                                        </td>

                                        <td class="px-4 py-2 text-slate-700">
                                            @foreach ($movie->genres as $genre)
                                                {{ $genre->name }}@if (!$loop->last), @endif
                                            @endforeach
                                        </td>
                             
                                        <td class="px-4 py-2">

                                            <select
                                                onchange="
                                                    if (this.value === 'view') {
                                                        window.location.href = '{{ route('movies.show', $movie) }}';
                                                    }
                                        
                                                    if (this.value === 'edit') {
                                                        window.location.href = '{{ route('admin.movies.edit', $movie) }}';
                                                    }
                                        
                                                    if (this.value === 'delete') {
                                                        if (confirm('Are you sure you want to delete this movie?')) {
                                                            this.nextElementSibling.submit();
                                                        } else {
                                                            this.value = '';
                                                        }
                                                    }
                                                "
                                                class="rounded-md border border-slate-400 bg-white px-3 py-2 font-medium text-slate-700 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                            >
                                                <option value="" disabled selected>Actions</option>
                                                <option value="view">View</option>
                                                <option value="edit">Edit</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                        
                                            <form
                                                method="POST"
                                                action="{{ route('admin.movies.destroy', $movie) }}"
                                                class="hidden"
                                            >
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

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