<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Toca Ticketing') - Fun Events!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen relative">
    
    <!-- DYNAMIC BACKGROUND IMAGE -->
    @if(isset($backgroundImage))
        <div class="fixed inset-0 z-0">
            <img src="{{ asset('images/backgrounds/' . $backgroundImage) }}" 
                 alt="Background" 
                 class="w-full h-full object-cover">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-white/50"></div>
        </div>
    @else
        <!-- Default gradient -->
        <div class="fixed inset-0 z-0 bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-100"></div>
    @endif
    
    <!-- STATIC DECORATIONS -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none opacity-30 z-10">
        <div class="absolute top-10 left-10 text-5xl">🎈</div>
        <div class="absolute top-20 right-20 text-4xl">⭐</div>
        <div class="absolute bottom-32 left-1/4 text-5xl">💖</div>
        <div class="absolute top-1/3 right-1/3 text-4xl">✨</div>
        <div class="absolute bottom-20 right-10 text-5xl">🌟</div>
        <div class="absolute top-1/2 left-20 text-4xl">🎉</div>
        <div class="absolute bottom-1/4 right-1/4 text-5xl">🎪</div>
    </div>

    <!-- Navbar -->
    <nav class="bg-white border-b-4 border-gray-800 shadow-[0_8px_0_0_rgba(0,0,0,0.3)] sticky top-0 z-50 relative">
        <!-- Decorative Top Border -->
        <div class="h-3 bg-gradient-to-r from-toca-pink via-toca-purple via-toca-blue to-toca-yellow"></div>
        
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <span class="text-5xl group-hover:scale-110 transition-transform">🎪</span>
                    <div>
                        <div class="text-2xl md:text-3xl font-bold text-gray-800">
                            Toca Ticketing
                        </div>
                        <div class="text-xs text-toca-pink font-semibold">Fun Events for Everyone! ✨</div>
                    </div>
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('home') }}" class="px-6 py-2 rounded-full font-bold text-gray-800 hover:bg-orange-100 transition-all">
                        🏠 Home
                    </a>
                    
                    @guest
                        <a href="{{ route('login') }}" class="px-6 py-2 rounded-full font-bold text-gray-800 hover:bg-green-100 transition-all">
                            🔑 Login
                        </a>
                        <a href="{{ route('register') }}" class="toca-btn-pink">
                            ✨ Sign Up
                        </a>
                    @else
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 rounded-full font-bold text-gray-800 hover:bg-purple-200 transition-all">
                                ⚙️ Admin
                            </a>
                        @elseif(auth()->user()->isOrganizer())
                            <a href="{{ route('organizer.dashboard') }}" class="px-6 py-2 rounded-full font-bold text-gray-800 hover:bg-orange-200 transition-all">
                                🎨 Organizer
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="px-6 py-2 rounded-full font-bold text-gray-800 hover:bg-pink-200 transition-all">
                                🎫 My Tickets
                            </a>
                        @endif
                        
                        <div class="relative group">
                            <button class="flex items-center gap-2 px-6 py-2 rounded-full font-bold text-gray-800 hover:bg-yellow-200 transition-all">
                                <span>👤 {{ Str::limit(auth()->user()->name, 15) }}</span>
                                <span class="text-sm">▼</span>
                            </button>
                            
                            <!-- Dropdown -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-3xl border-4 border-gray-800 shadow-[8px_8px_0px_0px_rgba(0,0,0,0.3)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                                <div class="p-2">
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.reports.sales') }}"
                                        class="block px-4 py-3 font-bold text-gray-800 hover:bg-yellow-100 rounded-2xl transition">
                                            📊 Ticket Reports
                                        </a>
                                    @endif

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-3 hover:bg-red-100 rounded-2xl font-bold text-gray-800 transition">
                                            🚪 Logout
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden toca-btn-yellow text-2xl" onclick="toggleMobileMenu()">
                    ☰
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('home') }}" class="px-6 py-3 rounded-3xl bg-orange-100 font-bold text-gray-800 text-center">
                        🏠 Home
                    </a>
                    
                    @guest
                        <a href="{{ route('login') }}" class="px-6 py-3 rounded-3xl bg-green-100 font-bold text-gray-800 text-center">
                            🔑 Login
                        </a>
                        <a href="{{ route('register') }}" class="toca-btn-pink text-center">
                            ✨ Sign Up
                        </a>
                    @else
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 rounded-3xl bg-purple-200 font-bold text-gray-800 text-center">
                                ⚙️ Admin Dashboard
                            </a>
                        @elseif(auth()->user()->isOrganizer())
                            <a href="{{ route('organizer.dashboard') }}" class="px-6 py-3 rounded-3xl bg-orange-200 font-bold text-gray-800 text-center">
                                🎨 Organizer Dashboard
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="px-6 py-3 rounded-3xl bg-pink-200 font-bold text-gray-800 text-center">
                                🎫 My Dashboard
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full px-6 py-3 rounded-3xl bg-red-200 font-bold text-gray-800 text-center">
                                🚪 Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="container mx-auto px-4 mt-6 relative z-20">
        <div class="bg-green-500 border-4 border-gray-800 rounded-3xl p-4 flex items-center justify-between shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)]">
            <div class="flex items-center gap-3">
                <span class="text-4xl">✅</span>
                <span class="font-bold text-white text-lg">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-3xl text-white hover:scale-110 transition-transform">
                ✖️
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container mx-auto px-4 mt-6 relative z-20">
        <div class="bg-red-500 border-4 border-gray-800 rounded-3xl p-4 flex items-center justify-between shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)]">
            <div class="flex items-center gap-3">
                <span class="text-4xl">❌</span>
                <span class="font-bold text-white text-lg">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-3xl text-white hover:scale-110 transition-transform">
                ✖️
            </button>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="container mx-auto px-4 mt-6 relative z-20">
        <div class="bg-red-400 border-4 border-gray-800 rounded-3xl p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)]">
            <div class="flex items-center gap-3 mb-3">
                <span class="text-4xl">⚠️</span>
                <span class="font-bold text-white text-xl">Oops! Something went wrong:</span>
            </div>
            <ul class="list-disc list-inside ml-10 text-white font-semibold space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="relative z-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t-4 border-gray-800 mt-20 py-12 relative z-20 shadow-[0_-8px_0_0_rgba(0,0,0,0.3)]">
        <div class="absolute top-0 left-0 right-0 h-3 bg-gradient-to-r from-toca-yellow via-toca-orange via-toca-pink to-toca-purple"></div>
        
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-4">
                        <span class="text-4xl">🎪</span>
                        <h3 class="text-2xl font-bold text-gray-800">Toca Ticketing</h3>
                    </div>
                    <p class="text-gray-600 font-medium">
                        Your fun gateway to amazing events! 🎉✨
                    </p>
                </div>

                <div class="text-center">
                    <h4 class="font-bold text-xl mb-4 text-gray-800">Quick Links 🔗</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-toca-pink font-semibold transition">🏠 Browse Events</a></li>
                        @auth
                            @if(auth()->user()->isUser())
                            <li><a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-toca-blue font-semibold transition">🎫 My Tickets</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <div class="text-center md:text-right">
                    <h4 class="font-bold text-xl mb-4 text-gray-800">Contact Us 📞</h4>
                    <ul class="space-y-2 text-gray-600 font-semibold">
                        <li>📧 hello@tocaticket.com</li>
                        <li>📱 +62 123 456 7890</li>
                        <li>📍 Fun City, Happy Island</li>
                    </ul>
                </div>
            </div>

            <div class="border-t-4 border-gray-800 pt-6 text-center">
                <p class="text-gray-600 font-bold">
                    © 2025 Toca Ticketing • Made with 💖 and ✨
                </p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
