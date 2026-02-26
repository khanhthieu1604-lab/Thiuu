@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<section class="min-h-screen flex items-center justify-center py-16" style="background: linear-gradient(135deg, #1a472a 0%, #2d5a3d 100%);">
    <div class="container-custom">
        <div class="max-w-md mx-auto">
            <div class="bg-white p-8 shadow-lg">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-green-800 flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-2xl">K</span>
                    </div>
                    <h1 class="text-2xl font-bold" style="font-family: 'Playfair Display', serif;">Tạo tài khoản</h1>
                    <p class="text-gray-500 mt-2">Tham gia KThiuu Hotel ngay hôm nay</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="form-input @error('name') border-red-500 @enderror"
                            placeholder="Nguyễn Văn A">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
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
                            placeholder="Tối thiểu 8 ký tự">
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="form-input"
                            placeholder="Nhập lại mật khẩu">
                    </div>

                    <!-- Terms -->
                    <div class="mb-6">
                        <label class="flex items-start">
                            <input type="checkbox" name="terms" required class="w-4 h-4 mt-1 text-green-600 border-gray-300 focus:ring-green-500">
                            <span class="ml-2 text-sm text-gray-600">
                                Tôi đồng ý với <a href="#" class="text-green-800 hover:underline">Điều khoản dịch vụ</a>
                                và <a href="#" class="text-green-800 hover:underline">Chính sách bảo mật</a>
                            </span>
                        </label>
                    </div>

                    <button type="submit" class="btn-primary w-full mb-6">
                        Đăng ký
                    </button>

                    <p class="text-center text-gray-600">
                        Đã có tài khoản?
                        <a href="{{ route('login') }}" class="text-green-800 font-semibold hover:underline">Đăng nhập</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection