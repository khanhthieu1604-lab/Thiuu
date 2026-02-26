<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        {{-- Total Bookings --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-6 hover:scale-105 transition-transform">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Bookings</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_bookings'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-check text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        {{-- Pending Bookings --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-6 hover:scale-105 transition-transform">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['pending_bookings'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-clock text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>

        {{-- Revenue --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-6 hover:scale-105 transition-transform">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Revenue (Paid)</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">${{ number_format($stats['total_revenue'], 2) }}</p>
                </div>
                <div class="w-14 h-14 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-dollar-sign text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        {{-- Hotels --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-6 hover:scale-105 transition-transform">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Hotels</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_hotels'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-hotel text-2xl text-indigo-600"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <i class="fa-solid fa-chart-bar text-blue-600"></i> Bookings (Last 7 Days)
            </h3>
            <canvas id="bookingsChart"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-green-600"></i> Revenue (Last 7 Days)
            </h3>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('admin.hotels.index') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-4 text-center hover:scale-105 transition-transform group">
            <i class="fa-solid fa-hotel text-3xl text-blue-600 mb-2 group-hover:animate-float"></i>
            <p class="font-semibold text-sm text-gray-900 dark:text-white">Manage Hotels</p>
        </a>

        <a href="{{ route('admin.bookings.index') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-4 text-center hover:scale-105 transition-transform group">
            <i class="fa-solid fa-calendar-check text-3xl text-cyan-600 mb-2 group-hover:animate-float"></i>
            <p class="font-semibold text-sm text-gray-900 dark:text-white">Manage Bookings</p>
        </a>

        <a href="{{ route('admin.hotels.create') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-4 text-center hover:scale-105 transition-transform group">
            <i class="fa-solid fa-plus-circle text-3xl text-green-600 mb-2 group-hover:animate-float"></i>
            <p class="font-semibold text-sm text-gray-900 dark:text-white">Add Hotel</p>
        </a>

        <a href="#" class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 p-4 text-center hover:scale-105 transition-transform group">
            <i class="fa-solid fa-users text-3xl text-amber-600 mb-2 group-hover:animate-float"></i>
            <p class="font-semibold text-sm text-gray-900 dark:text-white">Users</p>
        </a>
    </div>

    {{-- Recent Bookings --}}
    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
        <i class="fa-solid fa-history text-gray-600"></i> Recent Bookings
    </h3>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Hotel / Room</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Dates</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach ($recentBookings as $booking)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">#{{ $booking->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $booking->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $booking->room->hotel->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500">{{ $booking->room->type }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $booking->check_in }} <i class="fa-solid fa-arrow-right text-xs mx-1"></i> {{ $booking->check_out }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($booking->status === 'confirmed')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                Confirmed
                            </span>
                            @elseif($booking->status === 'pending')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                Pending
                            </span>
                            @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                Cancelled
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);

            // Bookings Chart
            new Chart(document.getElementById('bookingsChart'), {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'New Bookings',
                        data: chartData.bookings,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Revenue Chart
            new Chart(document.getElementById('revenueChart'), {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Revenue ($)',
                        data: chartData.revenue,
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgba(34, 197, 94, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
</x-admin-layout>