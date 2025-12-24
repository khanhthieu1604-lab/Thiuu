@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-10 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white font-heading transition-colors">Quản lý Đội xe</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">Danh sách và trạng thái tất cả các xe trong hệ thống.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.vehicles.create') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-800 hover:bg-blue-900 dark:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none transition uppercase tracking-wide">
                    <i class="fa-solid fa-plus mr-2"></i> Thêm xe mới
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border-l-4 border-blue-800 dark:border-blue-500 transition-colors duration-300">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Tổng số xe</dt>
                    <dd class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $vehicles->total() }}</dd>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border-l-4 border-green-500 transition-colors duration-300">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Sẵn sàng phục vụ</dt>
                    <dd class="mt-1 text-3xl font-bold text-green-600 dark:text-green-400">
                        {{ \App\Models\Vehicle::where('status', 'available')->count() }}
                    </dd>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border-l-4 border-yellow-500 transition-colors duration-300">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Đang cho thuê</dt>
                    <dd class="mt-1 text-3xl font-bold text-yellow-600 dark:text-yellow-400">
                        {{ \App\Models\Vehicle::where('status', 'rented')->count() }}
                    </dd>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="rounded-md bg-green-50 dark:bg-green-900/30 p-4 mb-6 border border-green-200 dark:border-green-800">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-check text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-300">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-300">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-blue-900 dark:bg-gray-950 text-white">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Thông tin xe</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Phân loại</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Giá thuê/ngày</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Trạng thái</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-24 bg-gray-100 dark:bg-gray-700 rounded-md overflow-hidden border border-gray-200 dark:border-gray-600 relative">
                                        @if($vehicle->image)
                                            <img class="h-full w-full object-cover" src="{{ asset($vehicle->image) }}" alt="">
                                        @else
                                            <div class="flex items-center justify-center h-full text-gray-400"><i class="fa-solid fa-image"></i></div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $vehicle->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">ID: #{{ $vehicle->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-200 font-medium">{{ $vehicle->brand }}</div>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 mt-1 border border-gray-200 dark:border-gray-600">
                                    {{ $vehicle->type }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-blue-800 dark:text-blue-400">{{ number_format($vehicle->rent_price_per_day) }}đ</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($vehicle->status == 'available')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-800">
                                        <i class="fa-solid fa-check mr-1.5 mt-0.5"></i> Sẵn sàng
                                    </span>
                                @elseif($vehicle->status == 'rented')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300 border border-yellow-200 dark:border-yellow-800">
                                        <i class="fa-solid fa-clock mr-1.5 mt-0.5"></i> Đang thuê
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                        <i class="fa-solid fa-wrench mr-1.5 mt-0.5"></i> Bảo trì
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/30 hover:bg-indigo-100 p-2 rounded-full transition" title="Sửa thông tin">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa xe này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 p-2 rounded-full transition" title="Xóa xe">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-800 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection