
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Thiuu Rental') }}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:300,400,500,700|playfair-display:700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Roboto', sans-serif; }
        .font-heading { font-family: 'Playfair Display', serif; }
    </style>

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="antialiased bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100 flex flex-col min-h-screen transition-colors duration-300">

   <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50 transition-colors duration-300">
        <div class="container mx-auto px-4 h-16 flex justify-between items-center">
            
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="group">
                    <img src="{{ asset('images/logo.png') }}" alt="Thiuu Rental" style="height: 48px; width: auto;" class="object-contain transition group-hover:opacity-90">
                </a>
            </div>

            <nav class="hidden md:flex items-center space-x-8 font-bold text-gray-700 dark:text-gray-300 uppercase text-xs tracking-wide">
                <a href="{{ route('home') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition py-2 {{ request()->routeIs('home') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Trang chủ</a>
                
                <a href="{{ route('vehicles.index') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition py-2 {{ request()->routeIs('vehicles.index') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Danh sách Xe</a>
                
                <a href="{{ route('services') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition py-2">Dịch vụ</a>
            </nav>

            <div class="flex items-center gap-3">
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2 transition">
                    <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-lg"></i>
                    <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-lg text-yellow-400"></i>
                </button>

                @auth
                @if(Auth::user()->role === 'master')
    <a href="{{ route('master.admins.index') }}" class="bg-purple-700 text-white px-3 py-2 rounded font-bold text-xs">
        <i class="fa-solid fa-crown mr-1"></i> Quản lý Admin
    </a>
@endif

@if(in_array(Auth::user()->role, ['admin', 'master']))
    <a href="{{ route('admin.dashboard') }}" class="bg-blue-800 text-white px-3 py-2 rounded font-bold text-xs">
        <i class="fa-solid fa-user-shield mr-1"></i> Admin Panel
    </a>
@endif
                    <div class="flex items-center gap-2">
                        <div class="hidden md:flex items-center gap-2 px-3 py-1.5 bg-gray-50 dark:bg-gray-700 rounded-full border border-gray-200 dark:border-gray-600">
                            <div class="w-6 h-6 rounded-full overflow-hidden border border-gray-300 dark:border-gray-500">
                                <img src="{{ asset('images/icon.png') }}" class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs font-bold text-blue-900 dark:text-blue-300 truncate max-w-[100px]">
                                {{ Auth::user()->name }}
                            </span>
                        </div>

                        {{-- Thay Dashboard bằng link Profile trực tiếp --}}
                        <a href="{{ route('profile.edit') }}" class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 px-3 py-2 rounded flex items-center hover:bg-gray-200 transition font-bold text-xs shadow border" title="Cài đặt tài khoản">
                            <i class="fa-solid fa-user-gear mr-1"></i> Tài khoản
                        </a>

                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="bg-blue-800 dark:bg-blue-700 text-white px-3 py-2 rounded flex items-center hover:bg-blue-900 transition font-bold text-xs shadow" title="Quản trị hệ thống">
                                <i class="fa-solid fa-user-shield mr-1"></i> Admin
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-50 dark:bg-red-900/20 text-red-600 w-9 h-9 rounded font-bold text-xs transition flex items-center justify-center hover:bg-red-500 hover:text-white" title="Đăng xuất">
                                <i class="fa-solid fa-power-off"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-yellow-500 text-blue-900 px-4 py-2 rounded hover:bg-yellow-400 transition font-bold text-xs shadow flex items-center">
                        <i class="fa-solid fa-user mr-2"></i> Đăng nhập
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow">
        @if(isset($slot) && $slot->isNotEmpty())
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>

    <footer class="bg-gray-900 dark:bg-black text-gray-300 pt-12 pb-8 mt-auto border-t-4 border-yellow-500 transition-colors duration-300">
        @include('layouts.partials.footer')
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');
        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>