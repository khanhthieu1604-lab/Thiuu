<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        // 1. Xóa sạch dữ liệu cũ
        DB::table('vehicles')->delete();

        // 2. Danh sách mẫu xe phong phú (15+ mẫu)
        $sampleCars = [
            ['name' => 'Mercedes-Benz C300 AMG', 'brand' => 'Mercedes', 'price' => 2500000],
            ['name' => 'Mercedes-Benz G63', 'brand' => 'Mercedes', 'price' => 12000000],
            ['name' => 'BMW 320i Sport Line', 'brand' => 'BMW', 'price' => 2200000],
            ['name' => 'Audi A6 S-Line', 'brand' => 'Audi', 'price' => 2800000],
            ['name' => 'Ford Ranger Wildtrak', 'brand' => 'Ford', 'price' => 1500000],
            ['name' => 'Ford Everest Titanium', 'brand' => 'Ford', 'price' => 1800000],
            ['name' => 'Honda Civic RS', 'brand' => 'Honda', 'price' => 1200000],
            ['name' => 'Honda CR-V L', 'brand' => 'Honda', 'price' => 1400000],
            ['name' => 'Toyota Camry 2.5Q', 'brand' => 'Toyota', 'price' => 1800000],
            ['name' => 'Toyota Fortuner Legender', 'brand' => 'Toyota', 'price' => 1600000],
            ['name' => 'Mazda CX-5 Premium', 'brand' => 'Mazda', 'price' => 1400000],
            ['name' => 'Kia Carnival Signature', 'brand' => 'Kia', 'price' => 2200000],
            ['name' => 'Kia Seltos Luxury', 'brand' => 'Kia', 'price' => 1000000],
            ['name' => 'Hyundai SantaFe', 'brand' => 'Hyundai', 'price' => 1600000],
            ['name' => 'VinFast Lux A2.0', 'brand' => 'VinFast', 'price' => 1300000],
            ['name' => 'VinFast VF8 Eco', 'brand' => 'VinFast', 'price' => 1500000],
            ['name' => 'Lexus RX350', 'brand' => 'Lexus', 'price' => 4500000],
            ['name' => 'Porsche Panamera', 'brand' => 'Porsche', 'price' => 8000000],
            ['name' => 'Mitsubishi Xpander', 'brand' => 'Mitsubishi', 'price' => 900000],
        ];

        $data = [];

        // 3. Vòng lặp tạo 120 xe
        for ($i = 1; $i <= 120; $i++) {
            // Lấy ngẫu nhiên 1 xe từ danh sách mẫu
            $randomCar = $sampleCars[array_rand($sampleCars)];

            // Random nhẹ giá tiền (+- 100k) cho tự nhiên
            $randomPrice = $randomCar['price'] + (rand(-1, 5) * 100000); 

            $data[] = [
                'name' => $randomCar['name'] . ' #' . $i, // Thêm số để không trùng tên
                'brand' => $randomCar['brand'],
                'description' => 'Xe đời mới ' . (2020 + rand(0, 4)) . ', nội thất sạch sẽ, bảo hiểm 2 chiều. Mã xe: ' . $i,
                'rent_price_per_day' => $randomPrice,
                'image' => 'images/1.jpg', // Vẫn dùng ảnh demo của bạn
                'status' => 'available',
                'created_at' => now()->subDays(rand(0, 30)), // Ngày tạo ngẫu nhiên trong tháng
                'updated_at' => now(),
            ];
        }

        // Chèn theo lô (Chunk) để chạy nhanh hơn, tránh lỗi quá tải query
        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('vehicles')->insert($chunk);
        }
    }
}