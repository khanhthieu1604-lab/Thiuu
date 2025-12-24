@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center relative bg-gray-900 py-10 px-4">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=2072&auto=format&fit=crop" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/80 via-blue-900/40 to-gray-900/90"></div>
    </div>

    <div class="relative z-10 w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden border-t-4 border-yellow-500 animate-fade-in-up">
        
        <div class="bg-white p-8 pb-0 text-center">
            <div class="flex justify-center mb-3">
                <img src="{{ asset('images/icon.png') }}" class="w-12 h-12 object-contain drop-shadow-sm">
            </div>
            <h2 class="text-2xl font-bold text-gray-800 font-heading uppercase tracking-wide">Tạo Tài Khoản</h2>
            <p class="text-gray-500 text-sm mt-1">Trở thành thành viên VIP ngay hôm nay</p>
        </div>

        <div class="p-8 pt-6">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Họ tên</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-800 transition"
                            placeholder="Nguyễn Văn A">
                    </div>
                    @error('name') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-800 transition"
                            placeholder="email@example.com">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Mật khẩu</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-800 transition"
                            placeholder="********">
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Xác nhận mật khẩu</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-solid fa-check-double"></i>
                        </span>
                        <input type="password" name="password_confirmation" required
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-800 transition"
                            placeholder="********">
                    </div>
                </div>

                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transform active:scale-95 transition duration-200 uppercase text-sm tracking-wider mt-2">
                    Đăng Ký Ngay
                </button>
            </form>

            <div class="mt-6 text-center text-sm border-t border-gray-100 pt-4">
                <span class="text-gray-500">Đã có tài khoản?</span>
                <a href="{{ route('login') }}" class="font-bold text-blue-800 hover:text-blue-900 ml-1 transition">Đăng nhập ngay</a>
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