@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-64px)] flex items-center justify-center relative bg-gray-900 py-10 px-4">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1562426509-5044a121aa49?q=80&w=2070&auto=format&fit=crop" 
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-900/80 to-blue-900/20"></div>
    </div>

    <div class="relative z-10 w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border-t-4 border-yellow-500 animate-fade-in-up transition-colors duration-300">
        
        <div class="p-8 pb-0 text-center">
            <div class="flex justify-center mb-4">
                {{-- Logo đã được thay thế và chỉnh nhỏ lại --}}
                <img src="{{ asset('images/logo.png') }}" alt="Thiuu Rental Logo" class="h-12 w-auto object-contain drop-shadow-md">
            </div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white font-heading uppercase tracking-wide">Tạo Tài Khoản</h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Trở thành thành viên VIP ngay hôm nay</p>
        </div>

        <div class="p-8 pt-6">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-1 ml-1">Họ tên</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-yellow-500 transition">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-gray-400"
                            placeholder="Nguyễn Văn A">
                    </div>
                    @error('name') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-1 ml-1">Email</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-yellow-500 transition">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-gray-400"
                            placeholder="email@example.com">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-1 ml-1">Mật khẩu</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-yellow-500 transition">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-gray-400"
                            placeholder="********">
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-1 ml-1">Xác nhận mật khẩu</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-yellow-500 transition">
                            <i class="fa-solid fa-check-double"></i>
                        </span>
                        <input type="password" name="password_confirmation" required
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-gray-400"
                            placeholder="********">
                    </div>
                </div>

                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transform active:scale-95 transition duration-200 uppercase text-sm tracking-wider mt-4">
                    Đăng Ký Ngay
                </button>
            </form>

            <div class="mt-6 text-center text-sm border-t border-gray-100 dark:border-gray-700 pt-4">
                <span class="text-gray-500 dark:text-gray-400">Đã có tài khoản?</span>
                <a href="{{ route('login') }}" class="font-bold text-blue-700 dark:text-yellow-500 hover:underline ml-1 transition">Đăng nhập ngay</a>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
</style>
@endsection