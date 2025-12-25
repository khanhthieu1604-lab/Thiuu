@extends('layouts.app')

@section('content')

    <div class="relative bg-gray-900 h-[600px] flex items-center transition-colors duration-300">
        <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=2070&auto=format&fit=crop"
             class="absolute inset-0 w-full h-full object-cover opacity-50 dark:opacity-30 transition-opacity duration-300">

        <div class="relative container mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <span class="bg-yellow-500 text-blue-900 font-bold px-3 py-1 text-xs uppercase tracking-widest mb-4 inline-block rounded-sm shadow">Uy tín - Chất lượng</span>
                <h1 class="text-4xl md:text-6xl font-bold font-heading leading-tight mb-6 drop-shadow-lg">
                    Thuê Xe Tự Lái & <br> Du Lịch Trọn Gói
                </h1>
                
                <div class="flex flex-wrap gap-4">
                    {{-- 1. CHƯA ĐĂNG NHẬP --}}
                    @guest
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded font-bold uppercase text-sm tracking-wider shadow-lg transform hover:-translate-y-1 transition">
                            Đăng nhập ngay
                        </a>
                    @endguest

                    {{-- 2. ĐÃ ĐĂNG NHẬP --}}
                    @auth
                        {{-- Nếu là ADMIN hoặc MASTER -> Hiện nút vào Dashboard Quản trị --}}
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'master')
                            <a href="{{ route('admin.dashboard') }}" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded font-bold uppercase text-sm tracking-wider shadow-lg transform hover:-translate-y-1 transition flex items-center">
                                <i class="fa-solid fa-gauge-high mr-2"></i> Dashboard Quản Trị
                            </a>
                        @else
                            {{-- Nếu là USER thường -> Hiện nút Dashboard cá nhân/Xem xe --}}
                            <a href="{{ route('dashboard') }}" class="bg-yellow-500 hover:bg-yellow-400 text-blue-900 px-8 py-3 rounded font-bold uppercase text-sm tracking-wider shadow-lg transform hover:-translate-y-1 transition">
                                <i class="fa-solid fa-user mr-2"></i> Trang Cá Nhân
                            </a>
                        @endif
                        
                        {{-- Nút xem xe chung cho tất cả --}}
                        <a href="{{ route('vehicles.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-8 py-3 rounded font-bold uppercase text-sm tracking-wider shadow-lg transform hover:-translate-y-1 transition">
                            Xem Danh Sách Xe
                        </a>
                    @endauth
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-2xl border-t-4 border-yellow-500 transform translate-y-8 lg:translate-y-0">
                 <div class="text-center text-gray-500 mt-4">
                    <i class="fa-solid fa-car-side text-4xl"></i>
                    <p class="mt-2 text-sm">Tìm chiếc xe ưng ý ngay hôm nay</p>
                 </div>
            </div>
        </div>
    </div>

    {{-- Phần hiển thị xe (Giữ nguyên code cũ) --}}
    {{-- ... --}}

@endsection