@extends('layouts.app')

@php
    $backgroundImage = 'organizer.jpg';
@endphp

@section('title', 'Organizer Dashboard')

@section('content')
<div class="relative overflow-hidden min-h-screen">

    <div class="container mx-auto px-4 py-12">
        
        <div class="text-center mb-16">
            <div class="flex justify-center items-center gap-4 mb-6">
                <span class="text-7xl">🎨</span>
                <div class="text-center">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-2">
                        Organizer Studio
                    </h1>
                    <p class="text-2xl text-gray-600 font-semibold">Create amazing events! ✨</p>
                </div>
                <span class="text-7xl">🎪</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="toca-card-elegant p-8 bg-gradient-to-br from-purple-100 to-pink-100 relative subtle-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-6xl">🎪</div>
                    <div class="text-right">
                        <div class="text-5xl font-bold text-gray-800">{{ $events->total() }}</div>
                        <div class="text-lg font-bold text-gray-700 mt-1">Total Events</div>
                    </div>
                </div>
                <div class="h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500" style="width: 100%"></div>
                </div>
            </div>
            
            <div class="toca-card-elegant p-8 bg-gradient-to-br from-blue-100 to-cyan-100 relative subtle-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-6xl">🎫</div>
                    <div class="text-right">
                        <div class="text-5xl font-bold text-gray-800">{{ $bookings->total() }}</div>
                        <div class="text-lg font-bold text-gray-700 mt-1">Total Bookings</div>
                    </div>
                </div>
                <div class="h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500" style="width: {{ $bookings->total() > 0 ? '80' : '0' }}%"></div>
                </div>
            </div>
            
            <div class="toca-card-elegant p-8 bg-gradient-to-br from-yellow-100 to-orange-100 relative subtle-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-6xl">💰</div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-pink-600">
                            Rp {{ number_format($bookings->where('status', 'approved')->sum('total_price') / 1000, 0) }}K
                        </div>
                        <div class="text-lg font-bold text-gray-700 mt-1">Revenue</div>
                    </div>
                </div>
                <div class="h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-500" style="width: 90%"></div>
                </div>
            </div>
        </div>

        <div class="toca-card-elegant p-8 bg-gradient-to-r from-pink-100 via-purple-100 to-blue-100 mb-12 text-center subtle-hover relative">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="text-7xl">➕</div>
                    <div class="text-left">
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">Ready to Create?</h3>
                        <p class="text-lg text-gray-700 font-bold">Start a new amazing event now!</p>
                    </div>
                </div>
                <a href="{{ route('organizer.events.create') }}" class="toca-btn-pink text-xl px-10">
                    Create New Event 🚀
                </a>
            </div>
        </div>

        <div class="mb-16">
            <div class="flex items-center gap-4 mb-8">
                <span class="text-5xl">🎪</span>
                <h2 class="text-4xl font-bold text-gray-800">My Events</h2>
            </div>
            
            @if($events->count() > 0)
                <div class="space-y-6">
                    @foreach($events as $event)
                        <div class="toca-card-elegant overflow-hidden bg-white relative">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6">
                                
                                <div class="lg:col-span-3">
                                    <div class="relative h-48 lg:h-full min-h-[200px] rounded-3xl overflow-hidden border-4 border-gray-800 shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]">
                                        @if($event->image)
                                            <img src="{{ asset('events/'.$event->image) }}" 
                                                alt="{{ $event->name }}" 
                                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="absolute inset-0 bg-gradient-to-br from-toca-pink to-toca-purple flex items-center justify-center">
                                                <span class="text-6xl">🎪</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="lg:col-span-6 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-start justify-between mb-3">
                                            <h3 class="text-3xl font-bold text-gray-800">{{ $event->name }}</h3>
                                            @if($event->category)
                                            <span class="toca-badge-elegant bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                                                {{ $event->category }}
                                            </span>
                                            @endif
                                        </div>
                                        
                                        <div class="space-y-2">
                                            <div class="flex items-center gap-3 text-gray-700 font-bold">
                                                <span class="text-2xl">📅</span>
                                                <span>{{ $event->event_date->format('d M Y, H:i') }}</span>
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-700 font-bold">
                                                <span class="text-2xl">📍</span>
                                                <span>{{ $event->location }}</span>
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-700 font-bold">
                                                <span class="text-2xl">🎫</span>
                                                <span>{{ $event->tickets_count }} ticket types</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="lg:col-span-3 flex flex-col gap-3">
                                    <a href="{{ route('event.show', $event->id) }}" 
                                        class="toca-btn-blue text-center py-3">
                                        👁️ View
                                    </a>
                                    <a href="{{ route('organizer.events.edit', $event->id) }}" 
                                        class="toca-btn-yellow text-center py-3">
                                        ✏️ Edit
                                    </a>
                                    <a href="{{ route('organizer.event.add-ticket', $event->id) }}" 
                                        class="toca-btn-green text-center py-3">
                                        🎫 Add Ticket
                                    </a>
                                    <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this event? 🗑️')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="w-full toca-btn-elegant bg-red-500 text-white py-3 font-bold">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8 flex justify-center">
                    <div class="toca-card-elegant p-4 bg-white relative">
                        {{ $events->links() }}
                    </div>
                </div>
            @else
                <div class="toca-card-elegant p-16 bg-gradient-to-br from-white to-purple-50 text-center subtle-hover relative">
                    <div class="text-8xl mb-6">🎪</div>
                    <h3 class="text-4xl font-bold text-gray-800 mb-4">No Events Yet!</h3>
                    <p class="text-xl text-gray-600 font-bold mb-8">
                        Time to create your first amazing event! 🚀
                    </p>
                    <a href="{{ route('organizer.events.create') }}" class="toca-btn-pink inline-block text-xl">
                        Create Your First Event ✨
                    </a>
                </div>
            @endif
        </div>

        <div>
            <div class="flex items-center gap-4 mb-8">
                <span class="text-5xl">📋</span>
                <h2 class="text-4xl font-bold text-gray-800">Recent Bookings</h2>
            </div>
            
            @if($bookings->count() > 0)
                <div class="toca-card-elegant overflow-hidden bg-white relative">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-purple-100 to-pink-100">
                                    <th class="text-left py-4 px-6 text-gray-800 font-bold text-lg border-b-4 border-gray-800">Customer</th>
                                    <th class="text-left py-4 px-6 text-gray-800 font-bold text-lg border-b-4 border-gray-800">Event</th>
                                    <th class="text-left py-4 px-6 text-gray-800 font-bold text-lg border-b-4 border-gray-800">Ticket</th>
                                    <th class="text-left py-4 px-6 text-gray-800 font-bold text-lg border-b-4 border-gray-800">Qty</th>
                                    <th class="text-left py-4 px-6 text-gray-800 font-bold text-lg border-b-4 border-gray-800">Total</th>
                                    <th class="text-left py-4 px-6 text-gray-800 font-bold text-lg border-b-4 border-gray-800">Status</th>
                                    <th class="text-left py-4 px-6 text-gray-800 font-bold text-lg border-b-4 border-gray-800">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr class="hover:bg-orange-50 transition-colors border-b-2 border-gray-200">
                                    <td class="py-4 px-6 text-gray-800 font-bold">{{ $booking->user->name }}</td>
                                    <td class="py-4 px-6 text-gray-700 font-semibold">{{ $booking->ticket->event->name }}</td>
                                    <td class="py-4 px-6 text-gray-700 font-semibold">{{ $booking->ticket->name }}</td>
                                    <td class="py-4 px-6 text-gray-700 font-semibold">{{ $booking->quantity }}</td>
                                    <td class="py-4 px-6 text-gray-800 font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    <td class="py-4 px-6">
                                        <span class="toca-badge-elegant text-xs
                                            {{ $booking->status === 'approved' ? 'bg-green-500 text-white' : '' }}
                                            {{ $booking->status === 'pending' ? 'bg-yellow-500 text-white' : '' }}
                                            {{ $booking->status === 'cancelled' ? 'bg-red-500 text-white' : '' }}">
                                            @if($booking->status === 'approved') ✅
                                            @elseif($booking->status === 'pending') ⏰
                                            @else ❌
                                            @endif
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600 font-semibold text-sm">{{ $booking->created_at->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="p-4 bg-gradient-to-r from-orange-50 to-yellow-50">
                        {{ $bookings->links() }}
                    </div>
                </div>
            @else
                <div class="toca-card-elegant p-16 bg-gradient-to-br from-white to-blue-50 text-center relative">
                    <div class="text-8xl mb-6">🎫</div>
                    <h3 class="text-3xl font-bold text-gray-800">No Bookings Yet!</h3>
                    <p class="text-lg text-gray-600 font-bold mt-2">
                        Bookings will appear here once people start buying tickets! 📊
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
