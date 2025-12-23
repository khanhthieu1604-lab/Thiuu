<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Tạo tài khoản ADMIN (Ông chủ)
        User::factory()->create([
            'name' => 'Admin Quản Trị',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'), // Mật khẩu dễ nhớ để test
            'role' => 'admin',
            'phone' => '0909000111',
            'address' => 'Hà Nội, Việt Nam'
        ]);

        // 2. Tạo tài khoản KHÁCH HÀNG (Người thuê xe)
        User::factory()->create([
            'name' => 'Khách Hàng Vip',
            'email' => 'khach@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'customer',
            'phone' => '0909000222',
            'address' => 'TP.HCM, Việt Nam'
        ]);

        // 3. Gọi các Seeder khác
        $this->call([
            // VehicleCategorySeeder::class, // Tạm ẩn cái này vì ta đã bỏ bảng Category
            VehicleSeeder::class,         // Tạo 120 xe mẫu
        ]);
    }
}