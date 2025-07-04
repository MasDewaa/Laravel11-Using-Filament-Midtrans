<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexa Reach</title>
    <link rel="icon" href="{{ asset('images/logoo.svg') }}">
    @vite('resources/css/app.css') <!-- Ganti dengan path CSS Anda -->
</head>

<body class="bg-gray-200">
<header>
    <nav class="py-2.5">
        <div class="flex flex-wrap justify-between items-center max-w-screen-xl mx-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('images/logoo.svg') }}" class="mr-3 h-6 sm:h-9" alt="NeXa Reach" />
                <span class="self-center text-xl font-semibold whitespace-nowrap">Nexa Reach</span>
            </a>

            <!-- Mobile menu button -->
            <div class="lg:hidden flex items-center">
                <button type="button" class="text-gray-700 hover:text-primary-700" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5h14a1 1 0 110 2H3a1 1 0 110-2zM3 9h14a1 1 0 110 2H3a1 1 0 110-2zM3 13h14a1 1 0 110 2H3a1 1 0 110-2z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Navbar Menu for larger screens -->
            <div class="hidden lg:flex items-center space-x-4 lg:space-x-10">
                <ul class="flex space-x-8 lg:space-x-10">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-700">Home</a></li>
                    <li><a href="#tentangkami" class="text-gray-700 hover:text-primary-700">Tentang Kami</a></li>
                    <li><a href="{{ route('dashboard#katalog') }}" class="text-gray-700 hover:text-primary-700">Katalog</a></li>
                    <li><a href="{{ route('transaksi.index') }}" class="text-gray-700 hover:text-primary-700">Transaksi</a></li>
                </ul>

                @guest
                <!-- Buttons for non-authenticated users -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-900 bg-gray border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">Register</a>
                </div>
                @endguest

                @auth
                <!-- Dropdown for authenticated users -->
                <div class="relative">
                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-50 hover:rounded-xl" id="menu-button" aria-expanded="false" aria-haspopup="true">
                        <img src="{{ asset('images/profile.svg') }}" alt="Profile" class="w-8 h-8 rounded-full mr-2">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        <svg class="w-5 h-5 ml-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div class="hidden absolute right-0 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5" id="user-dropdown" role="menu" aria-orientation="vertical" aria-labelledby="menu-button">
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700">Account settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full block px-4 py-2 text-left text-sm text-gray-700">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="lg:hidden" id="mobile-menu" style="display: none;">
        <ul class="space-y-4 py-4 px-6 bg-gray-100">
            <li><a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-700">Home</a></li>
            <li><a href="{{ route('dashboard#tentangkami') }}" class="text-gray-700 hover:text-primary-700">Tentang Kami</a></li>
            <li><a href="{{ route('dashboard#katalog') }}" class="text-gray-700 hover:text-primary-700">Katalog</a></li>
            <li><a href="{{ route('transaksi.index') }}" class="text-gray-700 hover:text-primary-700">Transaksi</a></li>
            
            <!-- User Profile or Login/Register options -->
            @auth
            <!-- Dropdown for authenticated users -->
            <li>
                <div class="relative">
                    <button type="button" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50 rounded-lg focus:outline-none" id="mobile-user-dropdown-button">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('images/profile.svg') }}" alt="Profile" class="w-6 h-6 rounded-full">
                            <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Mobile dropdown menu -->
                    <div class="hidden absolute left-0 mt-2 w-full origin-top-right bg-white shadow-lg ring-1 ring-black/5 rounded-md z-50" id="mobile-user-dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="mobile-user-dropdown-button">
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700">Account settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700">Support</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700">License</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full block px-4 py-2 text-left text-sm text-gray-700">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endauth

            @guest
            <li class="flex space-x-4">
                <a href="{{ route('login') }}" class="flex-1 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Login</a>
                <a href="{{ route('register') }}" class="flex-1 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Register</a>
            </li>
            @endguest
        </ul>
    </div>

</header>

<main>
    @yield('content')
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const userDropdownButton = document.getElementById('menu-button');
        const userDropdownMenu = document.getElementById('user-dropdown');
        const mobileUserDropdownButton = document.getElementById('mobile-user-dropdown-button');
        const mobileUserDropdownMenu = document.getElementById('mobile-user-dropdown-menu');

        // Toggle mobile menu visibility
        mobileMenuButton.addEventListener('click', function () {
            mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Toggle user dropdown menu on click
        userDropdownButton.addEventListener('click', function () {
            userDropdownMenu.classList.toggle('hidden');
        });

        mobileUserDropdownButton.addEventListener('click', function () {
            mobileUserDropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown menu when clicking outside
        document.addEventListener('click', function (event) {
            if (!userDropdownMenu.contains(event.target) && !userDropdownButton.contains(event.target)) {
                userDropdownMenu.classList.add('hidden');
            }
            if (!mobileUserDropdownMenu.contains(event.target) && !mobileUserDropdownButton.contains(event.target)) {
                mobileUserDropdownMenu.classList.add('hidden');
            }
        });
    });
</script>

</body>
</html>