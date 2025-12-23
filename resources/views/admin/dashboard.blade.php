@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Hệ thống quản trị Car Rental</h2>
    
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Tổng số xe</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalVehicles }}</h2>
                    </div>
                    <i class="fa-solid fa-car fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Khách hàng</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUsers }}</h2>
                    </div>
                    <i class="fa-solid fa-users fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Hợp đồng thuê</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalRentals }}</h2>
                    </div>
                    <i class="fa-solid fa-file-contract fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <h5 class="fw-bold mb-3">Xe mới cập nhật gần đây</h5>
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên xe</th>
                    <th>Hãng</th>
                    <th>Giá thuê</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentVehicles as $vehicle)
                <tr>
                    <td><img src="{{ asset($vehicle->image) }}" width="50" class="rounded"></td>
                    <td class="fw-bold">{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ number_format($vehicle->rent_price_per_day) }}đ</td>
                    <td><span class="badge bg-success">Sẵn sàng</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection