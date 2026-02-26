<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KThiuu Hotel') }} - @yield('title', 'Khách sạn sang trọng')</title>
    <meta name="description" content="@yield('description', 'KThiuu Hotel - Trải nghiệm nghỉ dưỡng đẳng cấp với không gian sang trọng và dịch vụ hoàn hảo.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="antialiased">
    <!-- Header -->
    <header class="header fixed top-0 left-0 right-0 z-50" id="mainHeader">
        <div class="container-custom">
            <!-- Top Bar -->
            <div class="hidden md:flex justify-between items-center py-2 border-b border-gray-100 text-sm">
                <div class="flex items-center gap-6 text-gray-600">
                    <a href="tel:19001833" class="flex items-center gap-2 hover:text-green-800">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                        1900 1833
                    </a>
                    <a href="mailto:contact@kthiuu-hotel.com" class="flex items-center gap-2 hover:text-green-800">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                        contact@kthiuu-hotel.com
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-green-800">Tài khoản</a>
                    @else
                    <a href="{{ route('login') }}" class="hover:text-green-800">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="hover:text-green-800">Đăng ký</a>
                    @endauth
                </div>
            </div>

            <!-- Main Navigation -->
            <nav class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-green-800 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">K</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900" style="font-family: 'Playfair Display', serif;">KThiuu Hotel</h1>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Luxury Experience</p>
                    </div>
                </a>

                <!-- Nav Links -->
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'text-green-800' : '' }}">Trang chủ</a>
                    <a href="{{ route('rooms.index') }}" class="nav-link {{ request()->routeIs('rooms.*') ? 'text-green-800' : '' }}">Phòng</a>
                    <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'text-green-800' : '' }}">Dịch vụ</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'text-green-800' : '' }}">Giới thiệu</a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-green-800' : '' }}">Liên hệ</a>
                </div>

                <!-- Booking Button -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('rooms.index') }}" class="btn-primary hidden md:inline-block">
                        Đặt phòng
                    </a>

                    <!-- Mobile Menu Button -->
                    <button class="lg:hidden p-2" id="mobileMenuBtn">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div class="lg:hidden hidden bg-white border-t" id="mobileMenu">
            <div class="container-custom py-4">
                <a href="{{ route('home') }}" class="block py-3 border-b">Trang chủ</a>
                <a href="{{ route('rooms.index') }}" class="block py-3 border-b">Phòng</a>
                <a href="{{ route('services.index') }}" class="block py-3 border-b">Dịch vụ</a>
                <a href="{{ route('about') }}" class="block py-3 border-b">Giới thiệu</a>
                <a href="{{ route('contact') }}" class="block py-3 border-b">Liên hệ</a>
                @auth
                <a href="{{ route('dashboard') }}" class="block py-3">Tài khoản</a>
                @else
                <a href="{{ route('login') }}" class="block py-3">Đăng nhập</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="{{ request()->routeIs('home') ? '' : 'pt-24' }}">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container-custom">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-amber-500 flex items-center justify-center">
                            <span class="text-gray-900 font-bold text-xl">K</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold" style="font-family: 'Playfair Display', serif;">KThiuu Hotel</h2>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Luxury Experience</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Trải nghiệm nghỉ dưỡng đẳng cấp với không gian sang trọng và dịch vụ hoàn hảo.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 border border-gray-600 flex items-center justify-center hover:border-amber-500 hover:text-amber-500 transition-colors">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 border border-gray-600 flex items-center justify-center hover:border-amber-500 hover:text-amber-500 transition-colors">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 border border-gray-600 flex items-center justify-center hover:border-amber-500 hover:text-amber-500 transition-colors">
                            <i data-lucide="youtube" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="footer-title">Liên kết</h3>
                    <a href="{{ route('home') }}" class="footer-link">Trang chủ</a>
                    <a href="{{ route('rooms.index') }}" class="footer-link">Phòng nghỉ</a>
                    <a href="{{ route('services.index') }}" class="footer-link">Dịch vụ</a>
                    <a href="{{ route('about') }}" class="footer-link">Giới thiệu</a>
                    <a href="{{ route('contact') }}" class="footer-link">Liên hệ</a>
                </div>

                <!-- Room Types -->
                <div>
                    <h3 class="footer-title">Loại phòng</h3>
                    <a href="{{ route('rooms.index', ['type' => 'luxury']) }}" class="footer-link">Luxury Suite</a>
                    <a href="{{ route('rooms.index', ['type' => 'grand']) }}" class="footer-link">Grand Room</a>
                    <a href="{{ route('rooms.index', ['type' => 'holiday']) }}" class="footer-link">Holiday Room</a>
                    <a href="{{ route('rooms.index', ['type' => 'standard']) }}" class="footer-link">Standard Room</a>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="footer-title">Liên hệ</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-amber-500 mt-1"></i>
                            <p class="text-gray-400">123 Đường ABC, Quận 1, TP. Hồ Chí Minh</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-5 h-5 text-amber-500"></i>
                            <a href="tel:19001833" class="text-gray-400 hover:text-amber-500">1900 1833</a>
                        </div>
                        <div class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-5 h-5 text-amber-500"></i>
                            <a href="mailto:contact@kthiuu-hotel.com" class="text-gray-400 hover:text-amber-500">contact@kthiuu-hotel.com</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} KThiuu Hotel. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>

    @stack('scripts')
</body>

</html>