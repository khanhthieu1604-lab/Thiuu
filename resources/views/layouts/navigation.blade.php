@php
    $isAdmin = Auth::user() && Auth::user()->role === 'admin';
    // Khôi phục giao diện Header cũ (Nền trắng/Sáng)
    $navClass = 'bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700';
@endphp

<nav x-data="{ open: false }" class="{{ $navClass }} sticky top-0 z-50 shadow-md transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="group">
                        <img src="{{ asset('images/logo.png') }}" alt="Thiuu Rental" style="height: 48px; width: auto;" class="object-contain transition group-hover:opacity-90">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center font-bold text-gray-700 dark:text-gray-300 uppercase text-xs tracking-wide">
                    <a href="{{ route('home') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition py-2 {{ request()->routeIs('home') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Trang chủ</a>
                    <a href="{{ route('vehicles.index') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition py-2 {{ request()->routeIs('vehicles.index') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Danh sách Xe</a>
                    
                    @if($isAdmin)
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition py-2 {{ request()->routeIs('admin.dashboard') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Tổng quan</a>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition py-2 {{ request()->routeIs('admin.users.*') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Người dùng</a>
                    @else
                        <a href="{{ route('services') }}" class="hover:text-blue-700 dark:hover:text-blue-400 transition py-2 {{ request()->routeIs('services') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Dịch vụ</a>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2 transition">
                    <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-lg"></i>
                    <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-lg text-yellow-400"></i>
                </button>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 px-3 py-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <div class="text-right hidden md:block">
                                    <p class="text-xs font-bold leading-none text-blue-900 dark:text-blue-300">{{ Auth::user()->name }}</p>
                                    <p class="text-[9px] uppercase tracking-widest opacity-60 mt-1 dark:text-gray-400">{{ Auth::user()->role }}</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-black text-xs shadow-md">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                <i class="fa-solid fa-user-gear mr-2 text-xs"></i> Tài khoản
                            </x-dropdown-link>
                            
                            @if($isAdmin)
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    <i class="fa-solid fa-user-shield mr-2 text-xs"></i> Quản trị
                                </x-dropdown-link>
                            @endif

                            <hr class="border-gray-100 dark:border-zinc-800 my-1">
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-red-600 font-bold" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa-solid fa-power-off mr-2 text-xs"></i> Đăng xuất
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="bg-yellow-500 text-blue-900 px-4 py-2 rounded hover:bg-yellow-400 transition font-bold text-xs shadow flex items-center">
                        <i class="fa-solid fa-user mr-2"></i> Đăng nhập
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>