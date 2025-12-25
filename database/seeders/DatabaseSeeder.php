<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. TÀI KHOẢN MASTER (Quyền lực nhất - Tạo được Admin)
        User::factory()->create([
            'name' => 'MASTER SYSTEM',
            'email' => 'master@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'master', // Role đặc biệt
            'phone' => '0999999999',
            'address' => 'Trụ sở chính'
        ]);

        // 2. TÀI KHOẢN ADMIN (Quản lý xe, đơn hàng - KHÔNG tạo được admin khác)
        User::factory()->create([
            'name' => 'Quản Lý Chi Nhánh 1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'phone' => '0988888888',
            'address' => 'Hà Nội'
        ]);

        // 3. KHÁCH HÀNG
        User::factory()->create([
            'name' => 'Khách Hàng Thân Thiết',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'customer',
        ]);

        // Gọi seeder xe
        $this->call(VehicleSeeder::class);
    }
}