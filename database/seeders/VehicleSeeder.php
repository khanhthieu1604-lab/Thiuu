<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\VehicleCategory;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $category = VehicleCategory::first();

        if (! $category) {
            return;
        }

        Vehicle::create([
            'category_id' => $category->id,
            'name' => 'Toyota Camry',
            'brand' => 'Toyota',
            'model' => 'Camry',
            'year' => 2022,
            'rent_price_per_day' => 1200000,
            'sale_price' => null,
            'is_for_rent' => true,
            'is_for_sale' => false,
            'description' => 'Sedan cao cấp, tiết kiệm nhiên liệu',
            'status' => 'available',
        ]);

        Vehicle::create([
            'category_id' => $category->id,
            'name' => 'Ford Ranger',
            'brand' => 'Ford',
            'model' => 'Ranger',
            'year' => 2023,
            'rent_price_per_day' => 1500000,
            'sale_price' => null,
            'is_for_rent' => true,
            'is_for_sale' => false,
            'description' => 'Bán tải mạnh mẽ, phù hợp địa hình',
            'status' => 'available',
        ]);
    }
}
