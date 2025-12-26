@extends('layouts.app')

@section('content')
<div class="bg-gray-100 dark:bg-zinc-950 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-black text-gray-800 dark:text-white uppercase tracking-tighter">Hệ thống Quản lý Người dùng</h2>
            <div class="bg-white dark:bg-zinc-900 px-4 py-2 rounded shadow-sm text-sm text-gray-500 border dark:border-zinc-800">
                Thành viên: <span class="font-bold text-blue-600">{{ $users->total() }}</span>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm font-bold shadow-sm">
                <i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm font-bold shadow-sm">
                <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ session('error') }}
            </div>
        @endif

        <div class="bg-white dark:bg-zinc-900 shadow-xl rounded-2xl overflow-hidden border border-gray-200 dark:border-zinc-800">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 dark:bg-zinc-800 text-gray-500 uppercase text-[10px] font-black tracking-widest border-b dark:border-zinc-700">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Khách hàng</th>
                            <th class="px-6 py-4">Mật khẩu</th>
                            <th class="px-6 py-4">Vai trò</th>
                            <th class="px-6 py-4 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800 text-sm">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition">
                            <td class="px-6 py-4 font-bold text-gray-400 italic">#{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold dark:text-white text-base">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] text-gray-400 bg-gray-50 dark:bg-zinc-800 px-2 py-1 rounded border dark:border-zinc-700 italic">
                                    <i class="fa-solid fa-lock mr-1"></i> Đã mã hóa
                                </span>
                            </td>
                            <td class="px-6 py-4 uppercase text-[10px] font-black">
                                @if($user->role === 'admin')
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded border border-red-200">Admin</span>
                                @else
                                    <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded border border-blue-200">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded transition" title="Thay đổi quyền hạn">
                                            <i class="fa-solid fa-user-shield"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn tài khoản này?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition" title="Xóa tài khoản">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">{{ $users->links() }}</div>
    </div>
</div>
@endsection