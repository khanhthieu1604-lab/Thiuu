<x-admin-layout>
    <x-slot name="header">
        Manage Hotels
    </x-slot>

    <div class="mb-4 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Hotel List</h3>
        <a href="{{ route('admin.hotels.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            <i class="fa-solid fa-plus mr-2"></i> Add New Hotel
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name / Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rooms</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($hotels as $hotel)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $hotel->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ $hotel->image ?? 'https://placehold.co/100x100' }}" class="h-10 w-16 object-cover rounded">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $hotel->name }}</div>
                        <div class="text-sm text-gray-500 truncate max-w-xs">{{ $hotel->address }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-500 font-bold">
                        <i class="fa-solid fa-star"></i> {{ $hotel->rating }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $hotel->rooms_count }} Rooms
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                        <a href="{{ route('admin.hotels.edit', $hotel) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" onsubmit="return confirm('Delete this hotel?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>