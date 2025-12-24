<x-app-layout>
    <div class="min-h-[calc(100vh-65px)] flex items-center justify-center relative bg-gray-900 py-10 px-4">
        
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=2072&auto=format&fit=crop" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/90 via-blue-900/40 to-gray-900/95"></div>
        </div>

        <div class="relative z-10 w-full max-w-4xl">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border-t-4 border-yellow-500 animate-fade-in-up">
                <div class="p-8 md:p-12 text-center text-white">
                    <div class="mb-6 flex justify-center">
                        <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center text-gray-900 text-3xl shadow-lg shadow-yellow-500/50">👑</div>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-bold font-heading mb-4 tracking-tight">
                        Xin chào, <span class="text-yellow-400">{{ Auth::user()->name }}</span>!
                    </h1>
                    <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                        Chào mừng bạn đến với Dashboard cá nhân. Bạn có thể xem danh sách xe hoặc cập nhật thông tin tại đây.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('vehicles.index') }}" class="px-8 py-4 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-bold rounded-xl shadow-lg hover:shadow-yellow-500/50 transform hover:-translate-y-1 transition duration-300 uppercase tracking-wider flex items-center justify-center gap-2">
                            <span>🚘</span> Xem Danh Sách Xe
                        </a>
                        <a href="{{ route('profile.edit') }}" class="px-8 py-4 bg-gray-800 hover:bg-gray-700 text-white font-bold rounded-xl shadow-lg border border-gray-600 hover:border-gray-500 transform hover:-translate-y-1 transition duration-300 flex items-center justify-center gap-2">
                            <span>⚙️</span> Tài Khoản
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }
    </style>
</x-app-layout>