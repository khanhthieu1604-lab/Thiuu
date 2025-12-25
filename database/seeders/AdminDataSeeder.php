<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Hash;

class AdminDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo tài khoản Admin trước (Để đảm bảo có user_id cho đơn hàng)
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Master',
                'password' => Hash::make('123123123'),
                'role' => 'admin',
                'phone' => '0909123456',
                'address' => 'Trụ sở chính Thiuu Rental',
                'email_verified_at' => now(),
            ]
        );

        // 2. Tạo 1 xe mẫu
        $car = Vehicle::create([
            'name' => 'Mercedes-Benz C200',
            'brand' => 'Mercedes',
            'type' => 'Sedan',
            'rent_price_per_day' => 2700000,
            'status' => 'available',
            'image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?q=80&w=2070&auto=format&fit=crop', // Ảnh tạm thời
            'description' => 'Dòng xe sang trọng, đẳng cấp dành cho doanh nhân.'
        ]);

        // 3. Tạo 1 đơn hàng (Sử dụng ID của Admin vừa tạo)
        Booking::create([
            'user_id' => $admin->id,
            'vehicle_id' => $car->id,
            'start_date' => now(),
            'end_date' => now()->addDays(2),
            'total_price' => 5400000,
            'status' => 'confirmed', 
            'note' => 'Giao xe đúng giờ tại sân bay Tân Sơn Nhất'
        ]);

        // 4. Tạo lịch sử bảo trì cho xe
        Maintenance::create([
            'vehicle_id' => $car->id,
            'type' => 'Thay dầu / Nhớt',
            'cost' => 1200000,
            'maintenance_date' => now()->subDays(5),
            'description' => 'Thay nhớt định kỳ tại Mercedes Vietnam.'
        ]);
    }
}