<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $h1 = Hotel::create([
            'name' => 'KThiuu Luxury Resort',
            'address' => '123 Beach Blvd, Ocean City',
            'description' => 'A structured paradise for developers looking to unwind.',
            'rating' => 4.8,
            'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
        ]);

        $h1->rooms()->createMany([
            [
                'type' => 'Deluxe Suite',
                'price' => 250.00,
                'capacity' => 2,
                'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                'description' => 'Spacious suite with a beautiful view of the ocean. Includes a private jacuzzi and premium amenities.',
                'amenities' => 'Wifi, Pool View, Jacuzzi, King Bed, Mini Bar',
                'is_available' => true,
            ],
            [
                'type' => 'Standard Room',
                'price' => 120.00,
                'capacity' => 2,
                'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                'description' => 'Comfortable room for a relaxing stay. perfect for solo travelers or couples.',
                'amenities' => 'Wifi, City View, Queen Bed',
                'is_available' => true,
            ]
        ]);

        $h2 = Hotel::create([
            'name' => 'KThiuu City Center',
            'address' => '404 Logic Lane, Silicon Valley',
            'description' => 'Modern aesthetics for the modern coder. High-speed internet included.',
            'rating' => 4.5,
            'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
        ]);

        $h2->rooms()->createMany([
            [
                'type' => 'Executive Suite',
                'price' => 300.00,
                'capacity' => 4,
                'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                'description' => 'Designed for productivity and comfort. Features a dedicated workspace and ergonomic furniture.',
                'amenities' => 'Wifi, Office Desk, Coffee Machine, Meeting Area',
                'is_available' => true,
            ]
        ]);
    }
}
