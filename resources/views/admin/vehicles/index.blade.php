@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Quản lý danh sách xe</h2>
        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-2"></i>Thêm xe mới
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên xe</th>
                            <th>Hãng</th>
                            <th>Giá thuê/ngày</th>
                            <th>Trạng thái</th>
                            <th class="text-end pe-4">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                        <tr>
                            <td class="ps-4 text-muted">#{{ $vehicle->id }}</td>
                            <td>
                                <img src="{{ asset($vehicle->image) }}" class="rounded" width="60" height="40" style="object-fit: cover;">
                            </td>
                            <td><strong>{{ $vehicle->name }}</strong></td>
                            <td><span class="badge bg-light text-dark border">{{ $vehicle->brand }}</span></td>
                            <td class="text-primary fw-bold">{{ number_format($vehicle->rent_price_per_day) }}đ</td>
                            <td>
                                @if($vehicle->status == 'available')
                                    <span class="badge bg-success-subtle text-success">Sẵn sàng</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Đang thuê</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm">
                                    <a href="#" class="btn btn-sm btn-outline-secondary" title="Sửa"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $vehicles->links() }}
    </div>
</div>
@endsection