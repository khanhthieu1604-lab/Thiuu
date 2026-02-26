<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Gradient Background với Floating Particles -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden"
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);">

        <!-- Floating Particles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-white/30 rounded-full animate-float"></div>
            <div class="absolute top-1/2 right-1/4 w-2 h-2 bg-pink-300/40 rounded-full animate-float-delay-1"></div>
            <div class="absolute bottom-1/3 left-1/3 w-4 h-4 bg-blue-300/30 rounded-full animate-float-delay-2"></div>
            <div class="absolute top-3/4 right-1/3 w-2 h-2 bg-cyan-300/40 rounded-full animate-float"></div>
            <div class="absolute bottom-1/4 right-1/2 w-3 h-3 bg-pink-200/30 rounded-full animate-float-delay-1"></div>
        </div>

        <!-- Logo/Brand -->
        <div class="mb-6 relative z-10">
            <a href="/" class="flex flex-col items-center">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mb-3 shadow-xl border border-white/40">
                    <i class="fa-solid fa-hotel text-4xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-white drop-shadow-lg">KThiuu-Hotel</h1>
                <p class="text-white/80 text-sm mt-1">Khanh Thieu</p>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md px-6 py-8 bg-white/90 backdrop-blur-md rounded-2xl relative z-10 shadow-2xl">
            {{ $slot }}
        </div>

        <!-- Back to Home Link -->
        <div class="mt-6 relative z-10">
            <a href="/" class="text-white text-sm hover:text-white/80 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Home
            </a>
        </div>

        <!-- Footer Credit -->
        <div class="mt-8 text-center text-white/60 text-xs relative z-10">
            <p>&copy; {{ date('Y') }} KThiuu-Hotel</p>
        </div>
    </div>
</body>

</html>