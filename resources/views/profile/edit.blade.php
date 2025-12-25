@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-black min-h-screen py-10 transition-colors duration-300 font-sans text-sm">
    <div class="container mx-auto px-4 max-w-5xl">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Hồ sơ của tôi</h1>
            <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">Cập nhật đầy đủ thông tin để quá trình thuê xe diễn ra nhanh chóng.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ================= CỘT TRÁI: THẺ THÀNH VIÊN ================= --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6 sticky top-24 text-center">
                    
                    <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-600 to-blue-800 dark:from-yellow-500 dark:to-yellow-700 rounded-full flex items-center justify-center shadow-lg mb-4 text-white dark:text-black font-bold text-3xl uppercase overflow-hidden">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>

                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>

                    <div class="mt-4 flex justify-center gap-2">
                        @if($user->phone && $user->address)
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-[10px] font-bold border border-green-200 uppercase tracking-wide flex items-center gap-1">
                                <i class="fa-solid fa-check-circle"></i> Hồ sơ đủ
                            </span>
                        @else
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-[10px] font-bold border border-yellow-200 uppercase tracking-wide animate-pulse">
                                Thiếu thông tin
                            </span>
                        @endif
                    </div>

                    <hr class="my-6 border-gray-100 dark:border-zinc-800">

                    <div class="space-y-3 text-left">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500 dark:text-gray-400">SĐT:</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $user->phone ?? 'Chưa cập nhật' }}</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500 dark:text-gray-400">Địa chỉ:</span>
                            <span class="font-bold text-gray-900 dark:text-white truncate max-w-[150px]" title="{{ $user->address }}">{{ $user->address ?? 'Chưa cập nhật' }}</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ================= CỘT PHẢI: FORM ================= --}}
            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h3 class="font-bold text-gray-900 dark:text-white text-base mb-1">Thông tin liên hệ</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Thông tin này sẽ được tự động điền vào Hợp đồng thuê xe.</p>

                    @if (session('status') === 'profile-updated')
                        <div class="mb-4 p-3 bg-green-50 text-green-700 text-xs rounded border border-green-200 flex items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i> Đã lưu thay đổi thành công.
                        </div>
                    @endif

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Họ và tên</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 dark:text-white transition">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 dark:text-white transition">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Số điện thoại <span class="text-red-500">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="0909..."
                                    class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 dark:text-white transition">
                                @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Địa chỉ thường trú <span class="text-red-500">*</span></label>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}" placeholder="Số nhà, đường, phường..."
                                    class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 dark:text-white transition">
                                @error('address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-5 py-2.5 bg-blue-800 hover:bg-blue-900 dark:bg-yellow-500 dark:hover:bg-yellow-400 text-white dark:text-black font-bold rounded-lg text-xs uppercase shadow-md transition">
                                <i class="fa-solid fa-save mr-1"></i> Lưu thông tin
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h3 class="font-bold text-gray-900 dark:text-white text-base mb-1">Đổi mật khẩu</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Mật khẩu mạnh giúp bảo vệ tài khoản của bạn.</p>

                    @if (session('status') === 'password-updated')
                        <div class="mb-4 p-3 bg-green-50 text-green-700 text-xs rounded border border-green-200 flex items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i> Đổi mật khẩu thành công.
                        </div>
                    @endif

                    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf
                        @method('put')

                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" required
                                class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 dark:text-white transition">
                             @error('current_password', 'updatePassword') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Mật khẩu mới</label>
                                <input type="password" name="password" required
                                    class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 dark:text-white transition">
                                @error('password', 'updatePassword') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Nhập lại mật khẩu</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 dark:text-white transition">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-5 py-2.5 bg-gray-800 hover:bg-gray-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 text-white font-bold rounded-lg text-xs uppercase shadow-md transition">
                                Cập nhật mật khẩu
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-red-50 dark:bg-red-900/10 rounded-xl shadow-sm border border-red-100 dark:border-red-900/30 p-6">
                    <h3 class="font-bold text-red-700 dark:text-red-500 text-base mb-1">Xóa tài khoản</h3>
                    <p class="text-xs text-red-600/70 dark:text-red-400 mb-6">Hành động này sẽ xóa vĩnh viễn dữ liệu và lịch sử đặt xe của bạn.</p>

                    <div class="flex justify-end">
                        <button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg text-xs uppercase shadow transition">
                            Xóa tài khoản
                        </button>
                    </div>

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-zinc-900">
                            @csrf
                            @method('delete')
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Bạn có chắc chắn?</h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Nhập mật khẩu để xác nhận xóa tài khoản.</p>
                            <div class="mt-6">
                                <input type="password" name="password" placeholder="Mật khẩu của bạn" class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg p-3 text-sm">
                                @error('password', 'userDeletion') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded font-bold text-xs uppercase">Hủy</button>
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded font-bold text-xs uppercase">Xóa</button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection