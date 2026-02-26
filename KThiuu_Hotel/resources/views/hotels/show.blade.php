<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $hotel->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Hotel Info --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <img src="{{ $hotel->image ?? 'https://placehold.co/1200x400' }}" alt="{{ $hotel->name }}" class="w-full h-80 object-cover">
                <div class="p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">{{ $hotel->name }}</h3>
                            <p class="text-gray-600 mb-4 flex items-center"><i class="fa-solid fa-location-dot mr-2"></i> {{ $hotel->address }}</p>
                            <div class="flex items-center gap-1 text-yellow-500 mb-4">
                                @for($i=0; $i<5; $i++)
                                    @if($i < floor($hotel->rating))
                                    <i class="fa-solid fa-star"></i>
                                    @else
                                    <i class="fa-regular fa-star"></i>
                                    @endif
                                    @endfor
                                    <span class="text-gray-400 text-sm ml-2">({{ $hotel->rating }})</span>
                            </div>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Luxury</span>
                    </div>
                    <p class="text-gray-700 leading-relaxed">{{ $hotel->description }}</p>
                </div>
            </div>

            {{-- Availability Filter --}}
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-lg font-bold mb-4">Check Availability</h3>
                <form action="{{ route('hotels.show', $hotel) }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Check-in Date</label>
                        <input type="date" name="check_in" value="{{ $checkIn }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Check-out Date</label>
                        <input type="date" name="check_out" value="{{ $checkOut }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 transition duration-150">
                            Search Rooms
                        </button>
                    </div>
                </form>
            </div>

            {{-- Room List --}}
            <h3 class="text-2xl font-bold mb-6">Available Rooms</h3>
            @if($rooms->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <p class="text-yellow-700">No rooms available for the selected dates. Please try another date range.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($rooms as $room)
                <div class="bg-white overflow-hidden shadow-lg rounded-xl flex flex-col h-full transform hover:-translate-y-1 transition duration-300">
                    <img src="{{ $room->image ?? 'https://placehold.co/600x400' }}" class="h-48 w-full object-cover">
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-xl font-bold">{{ $room->type }}</h4>
                            <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                <i class="fa-solid fa-user-group"></i> {{ $room->capacity }}
                            </span>
                        </div>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $room->description }}</p>
                        <p class="text-sm text-gray-500 mb-4 italic"><i class="fa-solid fa-bell-concierge mr-1"></i> {{ $room->amenities }}</p>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-2xl font-bold text-indigo-600">${{ $room->price }} <span class="text-sm text-gray-500 font-normal">/ night</span></span>
                            @auth
                            @if($checkIn && $checkOut)
                            <a href="{{ route('bookings.create', ['room' => $room->id, 'check_in' => $checkIn, 'check_out' => $checkOut]) }}" class="bg-green-600 text-white px-6 py-2 rounded-full font-bold hover:bg-green-700 transition shadow-md">
                                Book Now
                            </a>
                            @else
                            <button disabled class="bg-gray-300 text-gray-500 px-6 py-2 rounded-full font-bold cursor-not-allowed" title="Select dates first">
                                Select Dates
                            </button>
                            @endif
                            @else
                            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Login to Book</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-app-layout>