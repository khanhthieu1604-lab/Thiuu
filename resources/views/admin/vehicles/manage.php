@extends('layouts.app')

@section('content')
<div class="bg-gray-100 dark:bg-zinc-950 min-h-screen py-8 font-sans text-sm">
    <div class="container mx-auto px-4 max-w-6xl">

        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.vehicles.index') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow hover:bg-gray-50">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Quản lý Xe: {{ $vehicle->name }}</h1>
                <p class="text-xs text-gray-500">{{ $vehicle->brand }} • {{ $vehicle->type }} • Biển số: 51H-999.99</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 sticky top-24">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-wrench text-orange-500"></i> Thêm phiếu bảo trì
                    </h3>

                    <form action="{{ route('admin.maintenance.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Loại bảo trì</label>
                            <select name="type" class="w-full bg-gray-50 dark:bg-zinc-800 border-gray-200 dark:border-zinc-700 rounded-lg p-2.5 text-sm">
                                <option value="Bảo dưỡng định kỳ">Bảo dưỡng định kỳ</option>
                                <option value="Sửa chữa hư hỏng">Sửa chữa hư hỏng</option>
                                <option value="Thay dầu / Nhớt">Thay dầu / Nhớt</option>
                                <option value="Đăng kiểm">Đăng kiểm</option>
                                <option value="Rửa xe / Dọn nội thất">Rửa xe / Dọn nội thất</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Chi phí (VNĐ)</label>
                            <input type="number" name="cost" placeholder="Ví dụ: 500000" class="w-full bg-gray-50 dark:bg-zinc-800 border-gray-200 dark:border-zinc-700 rounded-lg p-2.5 text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ngày thực hiện</label>
                            <input type="date" name="maintenance_date" value="{{ date('Y-m-d') }}" class="w-full bg-gray-50 dark:bg-zinc-800 border-gray-200 dark:border-zinc-700 rounded-lg p-2.5 text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ghi chú chi tiết</label>
                            <textarea name="description" rows="3" placeholder="Chi tiết các hạng mục đã làm..." class="w-full bg-gray-50 dark:bg-zinc-800 border-gray-200 dark:border-zinc-700 rounded-lg p-2.5 text-sm"></textarea>
                        </div>

                        <button type="submit" class="w-full py-3 bg-gray-800 hover:bg-black text-white font-bold rounded-lg uppercase text-xs transition">
                            Lưu phiếu bảo trì
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-xl border border-red-100">
                        <p class="text-xs text-red-500 uppercase font-bold">Tổng chi phí sửa chữa</p>
                        <p class="text-2xl font-bold text-red-700 dark:text-red-500">{{ number_format($vehicle->maintenances->sum('cost')) }}đ</p>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100">
                        <p class="text-xs text-blue-500 uppercase font-bold">Số lần bảo trì</p>
                        <p class="text-2xl font-bold text-blue-700 dark:text-blue-500">{{ $vehicle->maintenances->count() }} lần</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 dark:border-zinc-800">
                        <h3 class="font-bold text-gray-800 dark:text-white">Lịch sử bảo trì</h3>
                    </div>
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 dark:bg-zinc-800 text-xs uppercase text-gray-500">
                            <tr>
                                <th class="px-4 py-3">Ngày</th>
                                <th class="px-4 py-3">Hạng mục</th>
                                <th class="px-4 py-3">Chi tiết</th>
                                <th class="px-4 py-3 text-right">Chi phí</th>
                                <th class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                            @foreach($vehicle->maintenances()->latest()->get() as $item)
                            <tr>
                                <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($item->maintenance_date)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase
                                        {{ $item->type == 'Sửa chữa hư hỏng' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                        {{ $item->type }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500 text-xs">{{ $item->description }}</td>
                                <td class="px-4 py-3 text-right font-bold text-gray-800 dark:text-white">{{ number_format($item->cost) }}đ</td>
                                <td class="px-4 py-3 text-right">
                                    <form action="{{ route('admin.maintenance.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Xóa dòng này?')">
                                        @csrf @method('DELETE')
                                        <button class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection