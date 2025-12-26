<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo User Admin mẫu để đăng nhập
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Mật khẩu là: password
            'role' => 'admin',
        ]);

        // 2. Tạo User Khách hàng mẫu
        User::factory()->create([
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // 3. Gọi Seeder tạo xe
        $this->call([
            VehicleSeeder::class,
            // VehicleCategorySeeder::class, (Nếu có)
        ]);
    }
}