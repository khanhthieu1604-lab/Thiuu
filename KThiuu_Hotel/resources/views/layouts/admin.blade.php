<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - KThiuu-Hotel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen hidden md:block">
            <div class="p-6 border-b border-gray-800">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-hotel text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">KThiuu-Hotel</h1>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </a>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 border-l-4 border-yellow-500' : '' }}">
                    <i class="fa-solid fa-gauge mr-3 w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.hotels.index') }}" class="block py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.hotels.*') ? 'bg-gray-800 border-l-4 border-yellow-500' : '' }}">
                    <i class="fa-solid fa-hotel mr-3 w-5"></i> Hotels
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="block py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.bookings.*') ? 'bg-gray-800 border-l-4 border-yellow-500' : '' }}">
                    <i class="fa-solid fa-calendar-check mr-3 w-5"></i> Bookings
                </a>
                <a href="/" class="block py-3 px-6 hover:bg-gray-800 mt-10 border-t border-gray-700">
                    <i class="fa-solid fa-arrow-left mr-3 w-5"></i> Back to Site
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        @yield('header')
                    </h2>
                    <div class="flex items-center">
                        <span class="mr-4 text-sm text-gray-600">Welcome, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-semibold">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-8 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>