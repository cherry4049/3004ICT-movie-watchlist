<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - CineTrack</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-md px-6 py-10">

            <h1 class="text-center text-3xl font-bold text-blue-600 sm:text-4xl">
                Login
            </h1>

            <!-- Success message -->
            @if (session('success'))
                <div class="mt-6 rounded-md border border-green-600 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

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

            <!-- Login form -->
            <form
                method="POST"
                action="{{ route('login') }}"
                class="mt-8 space-y-6"
            >
                @csrf

                <!-- Email -->
                <div>
                    <label
                        for="email"
                        class="mb-1 block font-medium text-slate-700"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        class="w-full rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label
                        for="password"
                        class="mb-1 block font-medium text-slate-700"
                    >
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        class="w-full rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                </div>

                <!-- Submit -->
                <div class="text-center">

                    <button
                        type="submit"
                        class="rounded-md bg-blue-600 px-6 py-3 font-bold text-white hover:bg-green-500 hover:text-black"
                    >
                        Login
                    </button>

                </div>

            </form>

            <!-- Register link -->
            <p class="mt-8 text-center text-slate-600">
                Don't have an account?

                <a
                    href="{{ route('register') }}"
                    class="font-medium text-blue-600 hover:text-green-500"
                >
                    Register
                </a>
            </p>

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>