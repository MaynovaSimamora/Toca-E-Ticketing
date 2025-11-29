@extends('layouts.app')

@php
    $backgroundImage = 'event-detail.jpg';
@endphp

@section('title', $event->name)

@section('content')
<div class="relative overflow-hidden bg-gradient-to-b from-orange-50 to-yellow-50">
    
    <!-- Back Button -->
    <div class="container mx-auto px-4 pt-8">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 toca-btn-blob bg-white text-gray-800 border-4 border-gray-800 px-6 py-3">
            <span class="text-2xl">←</span>
            <span class="font-bold">Back to Events</span>
        </a>
    </div>

    <!-- EVENT HERO - CREATIVE LAYOUT -->
    <div class="container mx-auto px-4 py-12 relative">
        
        <!-- Floating Deco -->
        <div class="absolute -top-10 right-20 text-8xl deco-float opacity-40">✨</div>
        <div class="absolute top-1/2 left-10 text-7xl bounce-twist opacity-30">🎉</div>
        
        <div class="relative z-10">
            <!-- Main Event Card -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-12">
                
                <!-- Left: Image (3 cols) -->
                <div class="lg:col-span-3">
                    <div class="sticker-card toca-card-wave overflow-hidden bg-white transform hover:scale-[1.02] transition-transform duration-500">
                        <div class="relative h-[500px]">
                            @if($event->image)
                                <img src="{{ asset('events/'.$event->image) }}" 
                                    alt="{{ $event->name }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-toca-pink via-toca-purple to-toca-blue flex items-center justify-center">
                                    <span class="text-9xl wiggle-fun">🎪</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Right: Info (2 cols) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Category Badge -->
                    @if($event->category)
                    <div>
                        <span class="toca-badge-cute bg-gradient-to-r from-purple-500 to-pink-500 text-white text-lg px-6 py-3">
                            <span>🎭</span>
                            {{ $event->category }}
                        </span>
                    </div>
                    @endif
                    
                    <!-- Event Title Card -->
                    <div class="toca-card-wave p-8 bg-gradient-to-br from-white to-pink-50 pulse-glow">
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 leading-tight">
                            {{ $event->name }}
                        </h1>
                        
                        <div class="flex items-center gap-3 text-gray-600 font-bold">
                            <span class="text-3xl">👤</span>
                            <span class="text-lg">by {{ $event->user->name }}</span>
                        </div>
                    </div>
                    
                    <!-- Event Details Cards -->
                    <div class="space-y-4">
                        <!-- Date Card -->
                        <div class="toca-card-wave p-6 bg-gradient-to-br from-yellow-100 to-orange-100 border-4 border-gray-800 shadow-toca-sm hover:shadow-toca transition-all transform hover:-rotate-1">
                            <div class="flex items-start gap-4">
                                <span class="text-5xl deco-float">📅</span>
                                <div>
                                    <div class="font-bold text-gray-800 text-xl mb-1">Date & Time</div>
                                    <div class="text-gray-700 font-semibold text-lg">
                                        {{ $event->event_date->format('l, d F Y') }}
                                    </div>
                                    <div class="text-gray-700 font-semibold text-lg">
                                        {{ $event->event_date->format('H:i') }} WIB
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Location Card -->
                        <div class="toca-card-wave p-6 bg-gradient-to-br from-green-100 to-teal-100 border-4 border-gray-800 shadow-toca-sm hover:shadow-toca transition-all transform hover:rotate-1">
                            <div class="flex items-start gap-4">
                                <span class="text-5xl bounce-twist">📍</span>
                                <div>
                                    <div class="font-bold text-gray-800 text-xl mb-1">Location</div>
                                    <div class="text-gray-700 font-semibold text-lg">
                                        {{ $event->location }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Favorite Button -->
                    @auth
                        @if(auth()->user()->isUser())
                        <form action="{{ route('user.favorite.toggle', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full toca-btn-blob bg-gradient-to-r from-red-400 to-pink-400 text-white border-4 border-gray-800 text-xl py-4">
                                @if($isFavorited)
                                    ❤️ Remove from Favorites
                                @else
                                    🤍 Add to Favorites
                                @endif
                            </button>
                        </form>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Description Section -->
            <div class="toca-card-wave p-10 bg-white mb-12 scallop-top">
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-6xl bounce-twist">📖</span>
                    <h2 class="text-4xl font-bold curved-text">About This Event</h2>
                </div>
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-700 text-xl leading-relaxed font-medium whitespace-pre-line">
                        {{ $event->description }}
                    </p>
                </div>
            </div>

            <!-- Tickets Section -->
            <div class="toca-card-wave p-10 bg-gradient-to-br from-white to-purple-50">
                <div class="flex items-center gap-4 mb-8">
                    <span class="text-6xl wiggle-fun">🎫</span>
                    <h2 class="text-4xl font-bold curved-text">Get Your Tickets!</h2>
                </div>
                
                @if($event->tickets->count() > 0)
                    <!-- Masonry-like Grid for Tickets -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($event->tickets as $index => $ticket)
                            @php
                                $colors = [
                                    'from-pink-100 to-purple-100',
                                    'from-blue-100 to-cyan-100',
                                    'from-yellow-100 to-orange-100',
                                    'from-green-100 to-emerald-100',
                                    'from-red-100 to-pink-100',
                                    'from-indigo-100 to-purple-100',
                                ];
                                $bgColor = $colors[$index % count($colors)];
                                
                                $rotations = ['rotate-1', '-rotate-1', 'rotate-0'];
                                $rotation = $rotations[$index % 3];
                            @endphp
                            
                            <div class="sticker-card {{ $rotation }} hover:rotate-0 transition-transform duration-300">
                                <div class="toca-card-wave overflow-hidden bg-gradient-to-br {{ $bgColor }} h-full flex flex-col">
                                    
                                    <!-- Ticket Image -->
                                    @if($ticket->image)
                                    <div class="h-40 relative overflow-hidden">
                                        <img src="{{ asset('storage/'.$ticket->image) }}" 
                                            alt="{{ $ticket->name }}" 
                                            class="w-full h-full object-cover">
                                    </div>
                                    @endif
                                    
                                    <!-- Ticket Content -->
                                    <div class="p-6 flex-1 flex flex-col">
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                            {{ $ticket->name }}
                                        </h3>
                                        
                                        @if($ticket->description)
                                        <p class="text-gray-600 font-semibold text-sm mb-4 flex-1">
                                            {{ $ticket->description }}
                                        </p>
                                        @endif
                                        
                                        <!-- Price Tag -->
                                        <div class="inline-flex items-baseline gap-2 mb-4">
                                            <span class="text-5xl font-bold text-gray-800">
                                                Rp
                                            </span>
                                            <span class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-toca-pink to-toca-purple">
                                                {{ number_format($ticket->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        
                                        <!-- Availability -->
                                        <div class="mb-4">
                                            @if($ticket->quantity > 0)
                                                <div class="toca-badge-cute bg-green-500 text-white">
                                                    <span>✅</span>
                                                    <span>{{ $ticket->quantity }} left!</span>
                                                </div>
                                            @else
                                                <div class="toca-badge-cute bg-red-500 text-white">
                                                    <span>❌</span>
                                                    <span>Sold Out</span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Book Button -->
                                        @auth
                                            @if(auth()->user()->isUser())
                                                @if($ticket->quantity > 0)
                                                <button onclick="openBookingModal({{ $ticket->id }}, '{{ $ticket->name }}', {{ $ticket->price }}, {{ $ticket->quantity }})" 
                                                    class="w-full toca-btn-pink">
                                                    Book Now! 🎉
                                                </button>
                                                @else
                                                <button disabled class="w-full toca-btn-blob bg-gray-300 text-gray-600 border-4 border-gray-800 opacity-50 cursor-not-allowed">
                                                    Sold Out 😢
                                                </button>
                                                @endif
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="block text-center toca-btn-blue w-full">
                                                Login to Book 🔑
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="text-9xl mb-6 bounce-twist">🎫</div>
                        <p class="text-3xl text-gray-600 font-bold">No tickets available yet!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- Booking Modal - Enhanced -->
@auth
    @if(auth()->user()->isUser())
    <div id="bookingModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center px-4">
        <div class="toca-card-wave max-w-md w-full p-8 bg-gradient-to-br from-white to-yellow-50 pulse-glow relative">
            
            <!-- Decorative Elements -->
            <div class="absolute -top-8 -right-8 text-6xl bounce-twist">🎉</div>
            <div class="absolute -bottom-4 -left-4 text-5xl deco-float">✨</div>
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold curved-text flex items-center gap-3">
                    <span class="text-4xl">🎫</span>
                    <span>Book Ticket</span>
                </h3>
                <button onclick="closeBookingModal()" class="text-5xl hover:scale-110 transition-transform">
                    ✖️
                </button>
            </div>
            
            <form action="{{ route('user.booking.store') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="ticket_id" id="modal_ticket_id">
                
                <div class="mb-6 p-6 bg-gradient-to-br from-purple-100 to-pink-100 rounded-3xl border-4 border-gray-800 shadow-toca-sm">
                    <div class="text-2xl font-bold text-gray-800 mb-2" id="modal_ticket_name"></div>
                    <div class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-toca-pink to-toca-purple mb-1" id="modal_ticket_price"></div>
                    <div class="text-sm text-gray-600 font-semibold" id="modal_ticket_available"></div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-2xl">🔢</span>
                        <span>Quantity</span>
                    </label>
                    <input type="number" name="quantity" id="modal_quantity" min="1" value="1" required
                        class="toca-input-fun" onchange="updateTotal()">
                </div>
                
                <div class="mb-6 p-6 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-3xl border-4 border-gray-800 shadow-toca-sm">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-2xl text-gray-800">Total:</span>
                        <span class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-toca-orange to-toca-pink" id="modal_total_price"></span>
                    </div>
                </div>
                
                <button type="submit" class="w-full toca-btn-purple text-2xl">
                    Confirm Booking! 🎊
                </button>
            </form>
        </div>
    </div>

    <script>
        let ticketPrice = 0;
        let maxQuantity = 0;

        function openBookingModal(ticketId, ticketName, price, available) {
            ticketPrice = price;
            maxQuantity = available;
            
            document.getElementById('modal_ticket_id').value = ticketId;
            document.getElementById('modal_ticket_name').textContent = ticketName;
            document.getElementById('modal_ticket_price').textContent = 'Rp ' + price.toLocaleString('id-ID');
            document.getElementById('modal_ticket_available').textContent = available + ' tickets available';
            document.getElementById('modal_quantity').max = available;
            
            updateTotal();
            
            document.getElementById('bookingModal').classList.remove('hidden');
            document.getElementById('bookingModal').classList.add('flex');
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.getElementById('bookingModal').classList.remove('flex');
        }

        function updateTotal() {
            const quantity = parseInt(document.getElementById('modal_quantity').value) || 1;
            const total = ticketPrice * quantity;
            document.getElementById('modal_total_price').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    </script>
    @endif
@endauth
@endsection
