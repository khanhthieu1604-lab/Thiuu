<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h1 class="text-3xl font-bold mb-4">Xin chào, {{ Auth::user()->name }}!</h1>
                    <p class="mb-8">Chào mừng bạn đến với dịch vụ thuê xe của chúng tôi.</p>
                    
                    <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        🚘 Xem danh sách xe
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>