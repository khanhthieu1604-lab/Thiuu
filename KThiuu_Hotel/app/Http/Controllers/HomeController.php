<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::orderBy('sort_order')->get();

        $featuredRooms = Room::with(['hotel', 'roomType', 'amenities'])
            ->take(6)
            ->get();

        $services = Service::active()
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('welcome', compact('roomTypes', 'featuredRooms', 'services'));
    }
}
