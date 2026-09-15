<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - CineTrack</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">

        <section class="mx-auto max-w-md px-6 py-10">

            <h1 class="text-center text-3xl font-bold text-blue-600 sm:text-4xl">
                Create an Account
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

            <!-- Register form -->
            <form
                method="POST"
                action="{{ route('register') }}"
                class="mt-8 space-y-6"
            >
                @csrf

                <!-- Name -->
                <div>
                    <label
                        for="name"
                        class="mb-1 block font-medium text-slate-700"
                    >
                        Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your name"
                        required
                        class="w-full rounded-md border border-slate-400 px-4 py-2 text-slate-900 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                </div>

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

                <!-- Confirm Password -->
                <div>
                    <label
                        for="password_confirmation"
                        class="mb-1 block font-medium text-slate-700"
                    >
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm your password"
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
                        Create Account
                    </button>

                </div>

            </form>

            <!-- Login link -->
            <p class="mt-8 text-center text-slate-600">
                Already have an account?

                <a
                    href="{{ route('login') }}"
                    class="font-medium text-blue-600 hover:text-green-500"
                >
                    Login
                </a>
            </p>

        </section>

    </main>

    @include('layouts.footer')

</body>
</html>