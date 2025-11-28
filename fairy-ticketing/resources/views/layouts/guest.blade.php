<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-100 min-h-screen">
    
    <!-- Cute Decorative Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none opacity-40">
        <div class="absolute top-10 left-10 text-5xl float-animation">🎈</div>
        <div class="absolute top-20 right-20 text-4xl float-animation" style="animation-delay: 0.5s">⭐</div>
        <div class="absolute bottom-32 left-1/4 text-5xl bounce-animation">💖</div>
        <div class="absolute top-1/3 right-1/3 text-4xl wiggle-animation">✨</div>
        <div class="absolute bottom-20 right-10 text-5xl float-animation" style="animation-delay: 1s">🌟</div>
    </div>

    <div class="relative z-10">
        {{ $slot }}
    </div>
</body>
</html>
