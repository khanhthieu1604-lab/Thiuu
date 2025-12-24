<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        // 1. Xóa sạch dữ liệu cũ để tránh trùng lặp
        DB::table('vehicles')->delete();

        // 2. Danh sách mẫu xe phong phú
        $sampleCars = [
            ['name' => 'Mercedes-Benz C300 AMG', 'brand' => 'Mercedes', 'price' => 2500000],
            ['name' => 'Mercedes-Benz G63', 'brand' => 'Mercedes', 'price' => 12000000],
            ['name' => 'BMW 320i Sport Line', 'brand' => 'BMW', 'price' => 2200000],
            ['name' => 'Audi A6 S-Line', 'brand' => 'Audi', 'price' => 2800000],
            ['name' => 'Ford Ranger Wildtrak', 'brand' => 'Ford', 'price' => 1500000],
            ['name' => 'Honda Civic RS', 'brand' => 'Honda', 'price' => 1200000],
            ['name' => 'Toyota Camry 2.5Q', 'brand' => 'Toyota', 'price' => 1800000],
            ['name' => 'Toyota Fortuner', 'brand' => 'Toyota', 'price' => 1600000],
            ['name' => 'Mazda CX-5', 'brand' => 'Mazda', 'price' => 1400000],
            ['name' => 'Kia Carnival', 'brand' => 'Kia', 'price' => 2200000],
            ['name' => 'Hyundai SantaFe', 'brand' => 'Hyundai', 'price' => 1600000],
            ['name' => 'VinFast VF8', 'brand' => 'VinFast', 'price' => 1500000],
            ['name' => 'Mitsubishi Xpander', 'brand' => 'Mitsubishi', 'price' => 900000],
        ];

        $data = [];

        // 3. Vòng lặp tạo 120 xe
        for ($i = 1; $i <= 120; $i++) {
            $randomCar = $sampleCars[array_rand($sampleCars)];
            // Random giá thuê (+- 100k)
            $randomPrice = $randomCar['price'] + (rand(-2, 5) * 100000); 

            $data[] = [
                'name' => $randomCar['name'] . ' #' . $i,
                'brand' => $randomCar['brand'],
                'description' => 'Xe đời mới ' . (2022 + rand(0, 3)) . ', nội thất sạch sẽ, đầy đủ tiện nghi. Mã xe: ' . $i,
                'rent_price_per_day' => $randomPrice,
                'image' => 'images/1.jpg', // Ảnh mặc định
                'status' => 'available',   // Trạng thái mặc định
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chèn theo lô (Chunk) để tối ưu tốc độ
        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('vehicles')->insert($chunk);
        }
    }
}