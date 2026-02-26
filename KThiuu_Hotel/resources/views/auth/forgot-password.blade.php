@extends('layouts.app')

@section('title', 'Quên mật khẩu')

@section('content')
<section class="min-h-screen flex items-center justify-center py-16" style="background: linear-gradient(135deg, #1a472a 0%, #2d5a3d 100%);">
    <div class="container-custom">
        <div class="max-w-md mx-auto">
            <div class="bg-white p-8 shadow-lg">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-green-800 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="key" class="w-8 h-8 text-white"></i>
                    </div>
                    <h1 class="text-2xl font-bold" style="font-family: 'Playfair Display', serif;">Quên mật khẩu?</h1>
                    <p class="text-gray-500 mt-2">Nhập email để nhận link đặt lại mật khẩu</p>
                </div>

                @if(session('status'))
                <div class="bg-green-100 text-green-700 px-4 py-3 mb-6 text-sm">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-input @error('email') border-red-500 @enderror"
                            placeholder="your@email.com">
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full mb-6">
                        Gửi link đặt lại mật khẩu
                    </button>

                    <p class="text-center">
                        <a href="{{ route('login') }}" class="text-green-800 hover:underline">← Quay lại đăng nhập</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush