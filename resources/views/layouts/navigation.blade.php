{{-- Logic phân quyền và thiết lập màu sắc giao diện --}}
@php
    $isAdmin = Auth::user() && Auth::user()->role === 'admin';
    // Admin: Nền đen (Zinc-900). Khách: Nền trắng mặc định.
    $navClass = $isAdmin ? 'bg-zinc-900 border-b border-zinc-800 text-white' : 'bg-white dark:bg-zinc-800 border-b border-gray-100 dark:border-zinc-700';
@endphp

<nav x-data="{ open: false }" class="{{ $navClass }} sticky top-0 z-50 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ $isAdmin ? route('admin.dashboard') : route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-9 h-9 rounded-lg {{ $isAdmin ? 'bg-red-600' : 'bg-blue-600' }} text-white flex items-center justify-center shadow-lg transition">
                            <i class="fa-solid {{ $isAdmin ? 'fa-screwdriver-wrench text-sm' : 'fa-car' }}"></i>
                        </div>
                        <span class="font-black text-lg tracking-tighter uppercase {{ $isAdmin ? 'text-white' : 'text-gray-900' }}">
                            {{ $isAdmin ? 'ADMIN' : 'THIUU' }}<span class="{{ $isAdmin ? 'text-red-500' : 'text-blue-600' }}">RENTAL</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    @if($isAdmin)
                        {{-- GIAO DIỆN MENU DÀNH RIÊNG CHO ADMIN --}}
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-gray-300 hover:text-white border-transparent hover:border-red-500">
                            <i class="fa-solid fa-chart-pie mr-2 text-xs"></i> {{ __('Tổng quan') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.*')" class="text-gray-300 hover:text-white border-transparent hover:border-red-500">
                            <i class="fa-solid fa-receipt mr-2 text-xs"></i> {{ __('Xử lý đơn') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.vehicles.index')" :active="request()->routeIs('admin.vehicles.*')" class="text-gray-300 hover:text-white border-transparent hover:border-red-500">
                            <i class="fa-solid fa-car-rear mr-2 text-xs"></i> {{ __('Quản lý xe') }}
                        </x-nav-link>

                        {{-- THAY THẾ TRANG DỊCH VỤ THÀNH QUẢN LÝ NGƯỜI DÙNG --}}
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-gray-300 hover:text-white border-transparent hover:border-red-500">
                            <i class="fa-solid fa-users-gear mr-2 text-xs"></i> {{ __('Người dùng') }}
                        </x-nav-link>
                    @else
                        {{-- GIAO DIỆN MENU DÀNH CHO KHÁCH HÀNG --}}
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">{{ __('Trang chủ') }}</x-nav-link>
                        <x-nav-link :href="route('vehicles.index')" :active="request()->routeIs('vehicles.index')">{{ __('Danh sách xe') }}</x-nav-link>
                        <x-nav-link :href="route('services')" :active="request()->routeIs('services')">{{ __('Dịch vụ') }}</x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 px-3 py-1.5 rounded-full border border-transparent transition-all {{ $isAdmin ? 'hover:bg-zinc-800 text-gray-300 hover:text-white' : 'hover:bg-gray-100 text-gray-500 hover:text-gray-700' }}">
                                <div class="text-right hidden md:block">
                                    <p class="text-xs font-bold leading-none">{{ Auth::user()->name }}</p>
                                    <p class="text-[10px] opacity-60 leading-tight mt-1 uppercase tracking-widest font-black {{ $isAdmin ? 'text-red-500' : '' }}">{{ Auth::user()->role }}</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr {{ $isAdmin ? 'from-red-600 to-orange-500' : 'from-blue-600 to-indigo-500' }} flex items-center justify-center text-white font-black text-xs shadow-md">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-100 dark:border-zinc-800">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Tài khoản</p>
                            </div>
                            
                            <x-dropdown-link :href="route('profile.edit')">
                                <i class="fa-regular fa-user mr-2 text-xs"></i> {{ __('Hồ sơ cá nhân') }}
                            </x-dropdown-link>

                            @if(!$isAdmin)
                                <x-dropdown-link :href="route('bookings.history')">
                                    <i class="fa-solid fa-clock-rotate-left mr-2 text-xs"></i> {{ __('Lịch sử thuê xe') }}
                                </x-dropdown-link>
                            @endif

                            <hr class="border-gray-100 dark:border-zinc-800 my-1">
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-red-600 font-bold"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa-solid fa-power-off mr-2 text-xs"></i> {{ __('Đăng xuất') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md transition {{ $isAdmin ? 'text-gray-400 hover:text-white hover:bg-zinc-800' : 'text-gray-400 hover:text-gray-500 hover:bg-gray-100' }}">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t {{ $isAdmin ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-gray-100' }}">
        <div class="pt-2 pb-3 space-y-1">
            @if($isAdmin)
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white bg-zinc-800">
                    {{ __('Tổng quan Admin') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.*')" class="text-gray-300">
                    {{ __('Xử lý đơn') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.vehicles.index')" :active="request()->routeIs('admin.vehicles.*')" class="text-gray-300">
                    {{ __('Quản lý xe') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-gray-300">
                    {{ __('Quản lý người dùng') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">{{ __('Trang chủ') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('vehicles.index')" :active="request()->routeIs('vehicles.index')">{{ __('Tìm xe') }}</x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>