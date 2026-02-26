@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<section class="min-h-screen flex items-center justify-center py-16" style="background: linear-gradient(135deg, #1a472a 0%, #2d5a3d 100%);">
    <div class="container-custom">
        <div class="max-w-md mx-auto">
            <div class="bg-white p-8 shadow-lg">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-green-800 flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-2xl">K</span>
                    </div>
                    <h1 class="text-2xl font-bold" style="font-family: 'Playfair Display', serif;">Đăng nhập</h1>
                    <p class="text-gray-500 mt-2">Chào mừng trở lại KThiuu Hotel</p>
                </div>

                <!-- Session Status -->
                @if(session('status'))
                <div class="bg-green-100 text-green-700 px-4 py-3 mb-6 text-sm">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-input @error('email') border-red-500 @enderror"
                            placeholder="your@email.com">
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input id="password" type="password" name="password" required
                            class="form-input @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                            <span class="ml-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-green-800 hover:underline">
                            Quên mật khẩu?
                        </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary w-full mb-6">
                        Đăng nhập
                    </button>

                    <p class="text-center text-gray-600">
                        Chưa có tài khoản?
                        <a href="{{ route('register') }}" class="text-green-800 font-semibold hover:underline">Đăng ký ngay</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection