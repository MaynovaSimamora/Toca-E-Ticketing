@extends('layouts.app')

@php
    $backgroundImage = 'dashboard.jpg';
@endphp

@section('title', 'My Dashboard')

@section('content')
<div class="relative overflow-hidden min-h-screen">

    <div class="container mx-auto px-4 py-12">
        
        <div class="text-center mb-16">
            <div class="flex justify-center items-center gap-4 mb-6">
                <span class="text-7xl">🎉</span>
                <div class="text-center">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-2">
                        Welcome, {{ auth()->user()->name }}!
                    </h1>
                    <p class="text-2xl text-gray-600 font-semibold">Your ticket paradise! 🎫✨</p>
                </div>
                <span class="text-7xl">🎪</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <div class="toca-card-elegant p-6 bg-gradient-to-br from-pink-100 to-purple-100 relative subtle-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-5xl font-bold text-gray-800">{{ $bookings->total() }}</div>
                        <div class="text-lg font-bold text-gray-700 mt-2">Total Bookings</div>
                    </div>
                    <div class="text-7xl">🎫</div>
                </div>
                <div class="mt-4 h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-pink-500 to-purple-500" style="width: 100%"></div>
                </div>
            </div>
            
            <div class="toca-card-elegant p-6 bg-gradient-to-br from-red-100 to-pink-100 relative subtle-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-5xl font-bold text-gray-800">{{ $favorites->total() }}</div>
                        <div class="text-lg font-bold text-gray-700 mt-2">Favorite Events</div>
                    </div>
                    <div class="text-7xl">❤️</div>
                </div>
                <div class="mt-4 h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-red-500 to-pink-500" style="width: {{ $favorites->total() > 0 ? '80' : '0' }}%"></div>
                </div>
            </div>
            
            <div class="toca-card-elegant p-6 bg-gradient-to-br from-blue-100 to-cyan-100 relative subtle-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-5xl font-bold text-gray-800">
                            {{ $bookings->where('status', 'approved')->count() }}
                        </div>
                        <div class="text-lg font-bold text-gray-700 mt-2">Approved</div>
                    </div>
                    <div class="text-7xl">✅</div>
                </div>
                <div class="mt-4 h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500" style="width: 90%"></div>
                </div>
            </div>
        </div>

        <div class="mb-16">
            <div class="flex items-center gap-4 mb-8">
                <span class="text-5xl">🎫</span>
                <h2 class="text-4xl font-bold text-gray-800">My Bookings</h2>
            </div>
            
            @if($bookings->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($bookings as $booking)
                        <div class="toca-card-elegant overflow-hidden bg-gradient-to-br from-white to-purple-50 relative">
                            <div class="p-6">
                                
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                            {{ $booking->ticket->event->name }}
                                        </h3>
                                        <div class="toca-badge-elegant 
                                            {{ $booking->status === 'approved' ? 'bg-green-500 text-white' : '' }}
                                            {{ $booking->status === 'pending' ? 'bg-yellow-500 text-white' : '' }}
                                            {{ $booking->status === 'cancelled' ? 'bg-red-500 text-white' : '' }}">
                                            <span>
                                                @if($booking->status === 'approved') ✅
                                                @elseif($booking->status === 'pending') ⏰
                                                @else ❌
                                                @endif
                                            </span>
                                            <span>{{ ucfirst($booking->status) }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">🎟️</span>
                                        <div class="text-gray-700 font-bold">
                                            {{ $booking->ticket->name }} × {{ $booking->quantity }}
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">💰</span>
                                        <div class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-toca-pink to-toca-purple">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">📅</span>
                                        <div class="text-gray-700 font-bold text-sm">
                                            {{ $booking->ticket->event->event_date->format('d M Y, H:i') }}
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">📍</span>
                                        <div class="text-gray-700 font-bold text-sm">
                                            {{ $booking->ticket->event->location }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex gap-3">
                                    <a href="{{ route('user.booking.show', $booking->id) }}" 
                                        class="flex-1 text-center toca-btn-blue py-3">
                                        View 👁️
                                    </a>
                                    
                                    @if($booking->status === 'pending')
                                    <form action="{{ route('user.booking.cancel', $booking->id) }}" method="POST" class="flex-1"
                                        onsubmit="return confirm('Cancel this booking? 🤔')">
                                        @csrf
                                        <button type="submit" class="w-full toca-btn-elegant bg-red-500 text-white py-3 text-sm font-bold">
                                            Cancel ❌
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8 flex justify-center">
                    <div class="toca-card-elegant p-4 bg-white relative">
                        {{ $bookings->links() }}
                    </div>
                </div>
            @else
                <div class="toca-card-elegant p-16 bg-gradient-to-br from-white to-orange-50 text-center subtle-hover relative">
                    <div class="text-8xl mb-6">😊</div>
                    <h3 class="text-4xl font-bold text-gray-800 mb-4">No Bookings Yet!</h3>
                    <p class="text-xl text-gray-600 font-bold mb-8">
                        Time to find some awesome events! 🔍
                    </p>
                    <a href="{{ route('home') }}" class="toca-btn-pink inline-block text-xl">
                        Browse Events 🎪
                    </a>
                </div>
            @endif
        </div>

        <div>
            <div class="flex items-center gap-4 mb-8">
                <span class="text-5xl">❤️</span>
                <h2 class="text-4xl font-bold text-gray-800">Favorite Events</h2>
            </div>
            
            @if($favorites->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favorites as $favorite)
                        <div class="toca-card-elegant overflow-hidden bg-white relative subtle-hover">
                            
                            <div class="relative h-48 overflow-hidden">
                                @if($favorite->event->image)
                                    <img src="{{ asset('storage/'.$favorite->event->image) }}" 
                                        alt="{{ $favorite->event->name }}" 
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-toca-pink to-toca-purple flex items-center justify-center">
                                        <span class="text-6xl">🎪</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-5 bg-gradient-to-br from-white to-pink-50">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">
                                    {{ $favorite->event->name }}
                                </h3>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                        <span class="text-xl">📅</span>
                                        <span>{{ $favorite->event->event_date->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                        <span class="text-xl">📍</span>
                                        <span>{{ $favorite->event->location }}</span>
                                    </div>
                                </div>
                                
                                <div class="flex gap-2">
                                    <a href="{{ route('event.show', $favorite->event->id) }}" 
                                        class="flex-1 text-center toca-btn-blue py-2 text-sm">
                                        View 👁️
                                    </a>
                                    <form action="{{ route('user.favorite.toggle', $favorite->event->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                            class="toca-btn-elegant bg-red-500 text-white px-4 py-2 text-xl">
                                            ❤️
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8 flex justify-center">
                    <div class="toca-card-elegant p-4 bg-white relative">
                        {{ $favorites->links() }}
                    </div>
                </div>
            @else
                <div class="toca-card-elegant p-16 bg-gradient-to-br from-white to-red-50 text-center subtle-hover relative">
                    <div class="text-8xl mb-6">💔</div>
                    <h3 class="text-4xl font-bold text-gray-800 mb-4">No Favorites Yet!</h3>
                    <p class="text-xl text-gray-600 font-bold mb-8">
                        Start adding events to your favorites! 💖
                    </p>
                    <a href="{{ route('home') }}" class="toca-btn-purple inline-block text-xl">
                        Discover Events ✨
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
