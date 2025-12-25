@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-l-4 border-blue-900 pl-4 uppercase">
            Tổng quan hệ thống
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-green-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-bold uppercase">Doanh thu tháng</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">125.5tr</h3>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full text-green-600 text-2xl">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                </div>
                <a href="#" class="text-green-600 text-sm font-bold mt-4 inline-block hover:underline">Xem chi tiết báo cáo &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-bold uppercase">Thành viên</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ \App\Models\User::count() }}</h3>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full text-blue-600 text-2xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                {{-- Chỉ Master mới thấy nút tạo Admin --}}
                @if(Auth::user()->role === 'master')
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="#" class="text-xs bg-blue-900 text-white px-3 py-1 rounded hover:bg-blue-800 transition">
                            + Tạo Admin Mới
                        </a>
                    </div>
                @else
                    <a href="#" class="text-blue-600 text-sm font-bold mt-4 inline-block hover:underline">Quản lý danh sách &rarr;</a>
                @endif
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-yellow-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-bold uppercase">Tổng xe</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ \App\Models\Vehicle::count() }}</h3>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full text-yellow-600 text-2xl">
                        <i class="fa-solid fa-car"></i>
                    </div>
                </div>
                <div class="mt-4 text-xs text-gray-500 space-y-1">
                    <div class="flex justify-between"><span>Sẵn sàng:</span> <span class="font-bold text-green-600">80%</span></div>
                    <div class="flex justify-between"><span>Đang thuê:</span> <span class="font-bold text-red-600">15%</span></div>
                    <div class="flex justify-between"><span>Bảo dưỡng:</span> <span class="font-bold text-gray-600">5%</span></div>
                </div>
                <a href="{{ route('admin.vehicles.index') }}" class="text-yellow-600 text-sm font-bold mt-3 inline-block hover:underline">Quản lý đội xe &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-purple-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-bold uppercase">Hợp đồng mới</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">12</h3>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full text-purple-600 text-2xl">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                </div>
                <a href="#" class="text-purple-600 text-sm font-bold mt-4 inline-block hover:underline">Xử lý yêu cầu &rarr;</a>
            </div>

        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="font-bold text-lg mb-4 text-gray-800">Yêu cầu thuê xe mới nhất</h3>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-500 border-b border-gray-200">
                        <th class="py-3 text-sm uppercase">Khách hàng</th>
                        <th class="py-3 text-sm uppercase">Xe yêu cầu</th>
                        <th class="py-3 text-sm uppercase">Ngày nhận</th>
                        <th class="py-3 text-sm uppercase">Trạng thái</th>
                        <th class="py-3 text-sm uppercase text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    <tr>
                        <td class="py-3">Nguyễn Văn A</td>
                        <td class="py-3 font-bold">Mazda CX-5 2023</td>
                        <td class="py-3">25/12/2025</td>
                        <td class="py-3"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Chờ duyệt</span></td>
                        <td class="py-3 text-right">
                            <button class="text-blue-600 hover:underline">Chi tiết</button>
                        </td>
                    </tr>
                    </tbody>
            </table>
        </div>

    </div>
</div>
@endsection