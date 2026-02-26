<x-admin-layout>
    <x-slot name="header">
        Manage Booking #{{ $booking->id }}
    </x-slot>

    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Booking Details --}}
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">Booking Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase">Hotel</label>
                    <p class="text-lg font-semibold">{{ $booking->room->hotel->name }}</p>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase">Room Type</label>
                    <p>{{ $booking->room->type }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Check-in</label>
                        <p>{{ $booking->check_in }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Check-out</label>
                        <p>{{ $booking->check_out }}</p>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase">Total Price</label>
                    <p class="text-xl font-bold text-indigo-600">${{ number_format($booking->total_price, 2) }}</p>
                </div>
            </div>

            <h3 class="text-lg font-bold mt-8 mb-4 border-b pb-2">Guest Information</h3>
            <div class="space-y-2">
                <p><span class="font-semibold">Name:</span> {{ $booking->user->name }}</p>
                <p><span class="font-semibold">Email:</span> {{ $booking->user->email }}</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="bg-white p-6 rounded-lg shadow-md h-fit">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">Update Status</h3>
            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Booking Status</label>
                    <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Payment Status</label>
                    <select name="payment_status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ $booking->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('admin.bookings.index') }}" class="text-gray-500 hover:text-gray-700">Back</a>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Update Booking</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>