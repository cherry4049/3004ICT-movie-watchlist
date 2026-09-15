<nav class="bg-slate-900 px-4 py-3 sm:px-6">

    <div class="relative mx-auto max-w-7xl">
    
        <!-- Top row -->
        <div class="flex w-full items-center justify-between">
    
            <!-- Logo -->
            <a href="{{ route('home') }}" class="shrink-0">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="CineTrack"
                    class="h-12 w-auto"
                >
            </a>
    
            <!-- Desktop navigation -->
            <div class="hidden items-center gap-6 lg:flex">
    
                <a
                    href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-blue-400' : 'text-white' }} font-medium hover:text-green-500"
                >
                    Home
                </a>
    
                <a
                    href="{{ route('movies.index') }}"
                    class="{{ request()->routeIs('movies.*') ? 'text-blue-400' : 'text-white' }} font-medium hover:text-green-500"
                >
                    Movies
                </a>
    
                @auth
    
                    <a
                        href="{{ route('my-reviews') }}"
                        class="{{ request()->routeIs('my-reviews') ? 'text-blue-400' : 'text-white' }} font-medium hover:text-green-500"
                    >
                        My Reviews
                    </a>
    
                    @if (auth()->user()->role === 'admin')
                        <a
                            href="{{ route('admin.movies.index') }}"
                            class="{{ request()->routeIs('admin.movies.*') ? 'text-blue-400' : 'text-white' }} font-medium hover:text-green-500"
                        >
                            Manage Movies
                        </a>
                    @endif
    
                    <span class="ml-4 text-white">
                        Hi, {{ auth()->user()->name }}
                    </span>
    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <button
                            type="submit"
                            class="rounded-md border border-white px-4 py-2 text-white hover:bg-white hover:text-slate-900"
                        >
                            Logout
                        </button>
                    </form>
    
                @else
    
                    <a
                        href="{{ route('login') }}"
                        class="{{ request()->routeIs('login') ? 'text-blue-400' : 'text-white' }} font-medium hover:text-green-500"
                    >
                        Login
                    </a>
    
                    <a
                        href="{{ route('register') }}"
                        class="{{ request()->routeIs('register') ? 'text-blue-400' : 'text-white' }} font-medium hover:text-green-500"
                    >
                        Register
                    </a>
    
                @endauth
    
            </div>
    
            <!-- Mobile/tablet greeting + hamburger -->
            <div class="flex items-center gap-4 lg:hidden">
    
                @auth
                    <span class="max-w-32 truncate text-white">
                        Hi, {{ auth()->user()->name }}
                    </span>
                @endauth
    
                <button
                    type="button"
                    id="mobile-menu-button"
                    class="rounded-md p-2 text-white hover:bg-slate-700"
                    aria-label="Open navigation menu"
                    aria-expanded="false"
                >
    
                    <!-- Hamburger icon -->
                    <svg
                        id="hamburger-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
    
                    <!-- Close icon -->
                    <svg
                        id="close-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        class="hidden h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
    
                </button>
    
            </div>
    
        </div>
    
        <!-- Mobile/tablet dropdown -->
        <div
            id="mobile-menu"
            class="absolute right-0 top-full z-50 mt-2 hidden w-56 rounded-md border border-black bg-white p-2 shadow-lg lg:hidden"
        >
    
            <div class="flex flex-col gap-2">
    
                <!-- Home -->
                <a
                    href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'border-blue-600 bg-blue-600 text-white' : 'border-black bg-transparent text-black' }} rounded-md border px-3 py-2 font-medium hover:border-green-500 hover:bg-green-500 hover:text-black"
                >
                    Home
                </a>
    
                <!-- Movies -->
                <a
                    href="{{ route('movies.index') }}"
                    class="{{ request()->routeIs('movies.*') ? 'border-blue-600 bg-blue-600 text-white' : 'border-black bg-transparent text-black' }} rounded-md border px-3 py-2 font-medium hover:border-green-500 hover:bg-green-500 hover:text-black"
                >
                    Movies
                </a>
    
                @auth
    
                    <!-- My Reviews -->
                    <a
                        href="{{ route('my-reviews') }}"
                        class="{{ request()->routeIs('my-reviews') ? 'border-blue-600 bg-blue-600 text-white' : 'border-black bg-transparent text-black' }} rounded-md border px-3 py-2 font-medium hover:border-green-500 hover:bg-green-500 hover:text-black"
                    >
                        My Reviews
                    </a>
    
                    <!-- Manage Movies -->
                    @if (auth()->user()->role === 'admin')
                        <a
                            href="{{ route('admin.movies.index') }}"
                            class="{{ request()->routeIs('admin.movies.*') ? 'border-blue-600 bg-blue-600 text-white' : 'border-black bg-transparent text-black' }} rounded-md border px-3 py-2 font-medium hover:border-green-500 hover:bg-green-500 hover:text-black"
                        >
                            Manage Movies
                        </a>
                    @endif
    
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <button
                            type="submit"
                            class="w-full rounded-md border border-red-600 bg-transparent px-3 py-2 text-left font-medium text-red-600 hover:border-yellow-400 hover:bg-yellow-400 hover:text-black"
                        >
                            Logout
                        </button>
                    </form>
    
                @else
    
                    <!-- Login -->
                    <a
                        href="{{ route('login') }}"
                        class="{{ request()->routeIs('login') ? 'border-blue-600 bg-blue-600 text-white' : 'border-black bg-transparent text-black' }} rounded-md border px-3 py-2 font-medium hover:border-green-500 hover:bg-green-500 hover:text-black"
                    >
                        Login
                    </a>
    
                    <!-- Register -->
                    <a
                        href="{{ route('register') }}"
                        class="{{ request()->routeIs('register') ? 'border-blue-600 bg-blue-600 text-white' : 'border-black bg-transparent text-black' }} rounded-md border px-3 py-2 font-medium hover:border-green-500 hover:bg-green-500 hover:text-black"
                    >
                        Register
                    </a>
    
                @endauth
    
            </div>
    
        </div>
    
    </div>

</nav>
    
<script>
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');
    
        menuButton.addEventListener('click', function () {
        const isOpen = !mobileMenu.classList.contains('hidden');
    
        mobileMenu.classList.toggle('hidden');
        hamburgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    
        menuButton.setAttribute('aria-expanded', !isOpen);
    
        menuButton.setAttribute(
            'aria-label',
            isOpen ? 'Open navigation menu' : 'Close navigation menu'
        );
    });
</script>
    