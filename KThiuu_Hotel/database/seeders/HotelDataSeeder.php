<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;
use App\Models\Amenity;
use App\Models\Service;

class HotelDataSeeder extends Seeder
{
    public function run(): void
    {
        // Room Types
        $roomTypes = [
            ['name' => 'Luxury', 'slug' => 'luxury', 'description' => 'Trải nghiệm đẳng cấp cao nhất với không gian rộng rãi và tiện nghi sang trọng.', 'sort_order' => 1],
            ['name' => 'Grand', 'slug' => 'grand', 'description' => 'Phòng nghỉ sang trọng với tầm nhìn đẹp và dịch vụ hoàn hảo.', 'sort_order' => 2],
            ['name' => 'Holiday', 'slug' => 'holiday', 'description' => 'Không gian nghỉ dưỡng thoải mái, lý tưởng cho kỳ nghỉ gia đình.', 'sort_order' => 3],
            ['name' => 'Standard', 'slug' => 'standard', 'description' => 'Phòng nghỉ tiện nghi với mức giá hợp lý.', 'sort_order' => 4],
        ];

        foreach ($roomTypes as $type) {
            RoomType::updateOrCreate(['slug' => $type['slug']], $type);
        }

        // Amenities
        $amenities = [
            ['name' => 'Wifi miễn phí', 'icon' => 'wifi', 'category' => 'general'],
            ['name' => 'Smart TV', 'icon' => 'tv', 'category' => 'entertainment'],
            ['name' => 'Điều hòa', 'icon' => 'snowflake', 'category' => 'general'],
            ['name' => 'Mini bar', 'icon' => 'coffee', 'category' => 'food'],
            ['name' => 'Bồn tắm', 'icon' => 'bath', 'category' => 'bathroom'],
            ['name' => 'Két an toàn', 'icon' => 'lock', 'category' => 'security'],
            ['name' => 'Phòng làm việc', 'icon' => 'briefcase', 'category' => 'business'],
            ['name' => 'View biển', 'icon' => 'waves', 'category' => 'view'],
            ['name' => 'Ban công', 'icon' => 'door-open', 'category' => 'general'],
            ['name' => 'Dọn phòng hàng ngày', 'icon' => 'sparkles', 'category' => 'service'],
        ];

        foreach ($amenities as $amenity) {
            Amenity::updateOrCreate(['name' => $amenity['name']], $amenity);
        }

        // Services
        $services = [
            [
                'name' => 'Nhà hàng & Bar',
                'slug' => 'nha-hang-bar',
                'description' => 'Thưởng thức ẩm thực đa dạng từ các đầu bếp hàng đầu trong không gian sang trọng.',
                'icon' => 'utensils',
                'sort_order' => 1,
            ],
            [
                'name' => 'Hồ bơi & Spa',
                'slug' => 'ho-boi-spa',
                'description' => 'Thư giãn tại hồ bơi ngoài trời hoặc trải nghiệm liệu pháp spa đẳng cấp.',
                'icon' => 'waves',
                'sort_order' => 2,
            ],
            [
                'name' => 'Hội nghị & Sự kiện',
                'slug' => 'hoi-nghi-su-kien',
                'description' => 'Không gian hội nghị hiện đại với sức chứa lên đến 500 khách.',
                'icon' => 'users',
                'sort_order' => 3,
            ],
            [
                'name' => 'Phòng Gym',
                'slug' => 'phong-gym',
                'description' => 'Phòng tập thể dục với trang thiết bị hiện đại, mở cửa 24/7.',
                'icon' => 'dumbbell',
                'sort_order' => 4,
            ],
            [
                'name' => 'Đưa đón VIP',
                'slug' => 'dua-don-vip',
                'description' => 'Dịch vụ đưa đón sân bay với xe sang trọng và tài xế chuyên nghiệp.',
                'icon' => 'car',
                'sort_order' => 5,
            ],
            [
                'name' => 'Dịch vụ Gia đình',
                'slug' => 'dich-vu-gia-dinh',
                'description' => 'Khu vui chơi trẻ em, dịch vụ trông trẻ và các tiện ích dành cho gia đình.',
                'icon' => 'baby',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
