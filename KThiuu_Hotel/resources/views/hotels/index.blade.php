<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hotels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($hotels as $hotel)
                <div class="anime-card bg-white overflow-hidden sm:rounded-lg opacity-0 translate-y-4 relative group shadow-lg">
                    <div class="relative overflow-hidden h-48">
                        <img src="{{ $hotel->image ?? 'https://placehold.co/600x400' }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors duration-300"></div>
                    </div>
                    <div class="p-6 card-content bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm">
                        <h3 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-600 mb-2">{{ $hotel->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-3"><i class="fa-solid fa-location-dot mr-1"></i> {{ $hotel->address }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center text-yellow-500">
                                @for($i=0; $i < floor($hotel->rating); $i++) <i class="fa-solid fa-star"></i> @endfor
                                    @if($hotel->rating - floor($hotel->rating) > 0) <i class="fa-solid fa-star-half-stroke"></i> @endif
                                    <span class="ml-1 text-gray-800 font-semibold">{{ $hotel->rating }}</span>
                            </div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Luxury Stay</span>
                        </div>
                        <a href="{{ route('hotels.show', $hotel) }}" class="uiverse-btn mt-6 block text-center py-3 rounded-lg shadow-md transform transition-transform group-hover:translate-y-[-2px]">
                            View Details <i class="fa-solid fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            anime({
                targets: '.anime-card',
                opacity: [0, 1],
                translateY: [20, 0],
                delay: anime.stagger(100), // delay increases by 100ms for each element.
                easing: 'easeOutQuad',
                duration: 800
            });
        });
    </script>
    </div>
    </div>
    </div>
</x-app-layout>