<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Amenity;
use App\Models\Hotel;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Get hotel (create if not exists)
        $hotel = Hotel::first();
        if (!$hotel) {
            $hotel = Hotel::create([
                'name' => 'KThiuu Hotel',
                'description' => 'Khách sạn sang trọng với dịch vụ đẳng cấp',
                'address' => '123 Đường ABC, Quận 1, TP. HCM',
                'rating' => 5,
            ]);
        }

        // Get room types
        $luxury = RoomType::where('slug', 'luxury')->first();
        $grand = RoomType::where('slug', 'grand')->first();
        $holiday = RoomType::where('slug', 'holiday')->first();
        $standard = RoomType::where('slug', 'standard')->first();

        // Get amenities
        $amenities = Amenity::all();

        // Room images
        $images = [
            'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80',
            'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80',
            'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80',
            'https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80',
            'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80',
            'https://images.unsplash.com/photo-1595576508898-0ad5c879a061?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80',
        ];

        // Create rooms
        $rooms = [
            // Luxury Rooms
            [
                'name' => 'Luxury Suite Ocean View',
                'description' => 'Phòng suite cao cấp nhất với tầm nhìn ra biển tuyệt đẹp, phòng khách rộng rãi và phòng ngủ riêng biệt. Tiện nghi 5 sao áp hiện đại.',
                'price' => 5500000,
                'capacity' => 4,
                'area' => 75,
                'bed_type' => '1 King & 1 Sofa bed',
                'room_type_id' => $luxury?->id,
                'image' => $images[0],
            ],
            [
                'name' => 'Luxury Suite Executive',
                'description' => 'Phòng suite sang trọng dành cho doanh nhân với khu vực làm việc riêng, phòng khách và mini bar cao cấp.',
                'price' => 4800000,
                'capacity' => 2,
                'area' => 65,
                'bed_type' => '1 King bed',
                'room_type_id' => $luxury?->id,
                'image' => $images[1],
            ],
            // Grand Rooms
            [
                'name' => 'Grand Deluxe City View',
                'description' => 'Phòng deluxe rộng rãi với tầm nhìn toàn cảnh thành phố, nội thất sang trọng và tiện nghi đầy đủ.',
                'price' => 3200000,
                'capacity' => 3,
                'area' => 50,
                'bed_type' => '1 King bed',
                'room_type_id' => $grand?->id,
                'image' => $images[2],
            ],
            [
                'name' => 'Grand Premium Suite',
                'description' => 'Phòng premium với thiết kế hiện đại, ban công riêng và bồn tắm jacuzzi.',
                'price' => 3800000,
                'capacity' => 2,
                'area' => 55,
                'bed_type' => '1 King bed',
                'room_type_id' => $grand?->id,
                'image' => $images[3],
            ],
            // Holiday Rooms
            [
                'name' => 'Holiday Family Room',
                'description' => 'Phòng gia đình lý tưởng cho kỳ nghỉ với 2 giường đôi, không gian rộng rãi và tiện nghi cho trẻ em.',
                'price' => 2500000,
                'capacity' => 4,
                'area' => 45,
                'bed_type' => '2 Queen beds',
                'room_type_id' => $holiday?->id,
                'image' => $images[4],
            ],
            [
                'name' => 'Holiday Twin Room',
                'description' => 'Phòng nghỉ thoải mái với 2 giường đơn, phù hợp cho bạn bè hoặc đồng nghiệp đi công tác.',
                'price' => 1800000,
                'capacity' => 2,
                'area' => 35,
                'bed_type' => '2 Single beds',
                'room_type_id' => $holiday?->id,
                'image' => $images[5],
            ],
            // Standard Rooms
            [
                'name' => 'Standard Double Room',
                'description' => 'Phòng tiêu chuẩn với giường đôi, tiện nghi đầy đủ và giá cả hợp lý.',
                'price' => 1200000,
                'capacity' => 2,
                'area' => 28,
                'bed_type' => '1 Double bed',
                'room_type_id' => $standard?->id,
                'image' => $images[0],
            ],
            [
                'name' => 'Standard Single Room',
                'description' => 'Phòng đơn tiện nghi cho khách đi một mình, đầy đủ tiện nghi cơ bản.',
                'price' => 900000,
                'capacity' => 1,
                'area' => 22,
                'bed_type' => '1 Single bed',
                'room_type_id' => $standard?->id,
                'image' => $images[1],
            ],
            // More rooms
            [
                'name' => 'Luxury Penthouse',
                'description' => 'Penthouse sang trọng nhất khách sạn với tầm nhìn 360 độ, phòng khách rộng, bếp riêng và sân thượng.',
                'price' => 8500000,
                'capacity' => 6,
                'area' => 120,
                'bed_type' => '2 King beds',
                'room_type_id' => $luxury?->id,
                'image' => $images[2],
            ],
            [
                'name' => 'Grand Corner Suite',
                'description' => 'Phòng góc với 2 mặt kính, ánh sáng tự nhiên và không gian mở.',
                'price' => 4200000,
                'capacity' => 3,
                'area' => 60,
                'bed_type' => '1 King & 1 Single',
                'room_type_id' => $grand?->id,
                'image' => $images[3],
            ],
            [
                'name' => 'Holiday Garden View',
                'description' => 'Phòng nghỉ với view vườn xanh mát, không gian yên tĩnh và thư giãn.',
                'price' => 2200000,
                'capacity' => 2,
                'area' => 40,
                'bed_type' => '1 Queen bed',
                'room_type_id' => $holiday?->id,
                'image' => $images[4],
            ],
            [
                'name' => 'Standard Economy',
                'description' => 'Phòng tiết kiệm cho du khách với tiện nghi cần thiết và giá tốt nhất.',
                'price' => 750000,
                'capacity' => 1,
                'area' => 18,
                'bed_type' => '1 Single bed',
                'room_type_id' => $standard?->id,
                'image' => $images[5],
            ],
        ];

        foreach ($rooms as $roomData) {
            // Determine type based on room_type_id
            $type = 'Standard';
            if ($roomData['room_type_id'] == $luxury?->id) $type = 'Luxury';
            elseif ($roomData['room_type_id'] == $grand?->id) $type = 'Grand';
            elseif ($roomData['room_type_id'] == $holiday?->id) $type = 'Holiday';

            $room = Room::updateOrCreate(
                ['name' => $roomData['name']],
                array_merge($roomData, [
                    'hotel_id' => $hotel->id,
                    'type' => $type,
                ])
            );

            // Attach random amenities
            if ($amenities->isNotEmpty()) {
                $randomAmenities = $amenities->random(min(6, $amenities->count()));
                $room->amenities()->sync($randomAmenities->pluck('id'));
            }
        }
    }
}
