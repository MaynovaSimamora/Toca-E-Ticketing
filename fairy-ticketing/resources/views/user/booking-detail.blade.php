@extends('layouts.app')

@php
    $backgroundImage = 'dashboard.jpg';
@endphp


@section('title', 'Booking Details')

@section('content')
<div class="container mx-auto px-4 py-12">
    
    <div class="max-w-3xl mx-auto">
        
        <!-- Booking Details Card -->
        <div class="toca-card p-8 mb-8 bg-gradient-to-br from-white to-toca-sky/20">
            
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-4xl font-bold text-gray-800 flex items-center gap-3">
                    <span>🎫</span>
                    <span>Booking Details</span>
                </h1>
                <span class="toca-badge text-lg
                    {{ $booking->status === 'approved' ? 'toca-badge-green' : '' }}
                    {{ $booking->status === 'pending' ? 'toca-badge-yellow' : '' }}
                    {{ $booking->status === 'cancelled' ? 'toca-badge-red' : '' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <!-- Event Info -->
            <div class="bg-toca-purple/20 border-4 border-gray-800 rounded-toca-xl p-6 mb-6">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ $booking->ticket->event->name }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800 font-bold">
                    <div>
                        <div class="text-lg mb-1">📅 Event Date</div>
                        <div class="text-gray-700">{{ $booking->ticket->event->event_date->format('l, d F Y') }}</div>
                        <div class="text-gray-700">{{ $booking->ticket->event->event_date->format('H:i') }} WIB</div>
                    </div>
                    
                    <div>
                        <div class="text-lg mb-1">📍 Location</div>
                        <div class="text-gray-700">{{ $booking->ticket->event->location }}</div>
                    </div>
                </div>
            </div>

            <!-- Ticket Info -->
            <div class="bg-toca-pink/20 border-4 border-gray-800 rounded-toca-xl p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span>🎟️</span>
                    <span>Ticket Information</span>
                </h3>
                
                <div class="space-y-3 text-gray-800 font-bold">
                    <div class="flex justify-between">
                        <span>Ticket Type:</span>
                        <span class="text-gray-700">{{ $booking->ticket->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Quantity:</span>
                        <span class="text-gray-700">{{ $booking->quantity }} ticket(s)</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Price per Ticket:</span>
                        <span class="text-gray-700">Rp {{ number_format($booking->ticket->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t-4 border-gray-800 pt-3 flex justify-between text-xl">
                        <span>Total Price:</span>
                        <span class="text-3xl text-toca-pink">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Booking Status -->
            <div class="bg-toca-yellow/20 border-4 border-gray-800 rounded-toca-xl p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span>📋</span>
                    <span>Booking Status</span>
                </h3>
                
                <div class="space-y-3 text-gray-800 font-bold">
                    <div class="flex justify-between">
                        <span>Booking ID:</span>
                        <span class="text-gray-700">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Booking Date:</span>
                        <span class="text-gray-700">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Status:</span>
                        <span class="font-bold 
                            {{ $booking->status === 'approved' ? 'text-green-600' : '' }}
                            {{ $booking->status === 'pending' ? 'text-yellow-600' : '' }}
                            {{ $booking->status === 'cancelled' ? 'text-red-600' : '' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                    
                    @if($booking->cancelled_at)
                    <div class="flex justify-between">
                        <span>Cancelled At:</span>
                        <span class="text-red-600">{{ $booking->cancelled_at->format('d M Y, H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Status Messages -->
            @if($booking->status === 'pending')
            <div class="bg-toca-yellow border-4 border-gray-800 rounded-toca-xl p-6 mb-6">
                <div class="flex items-start gap-3 text-white">
                    <span class="text-4xl">⏰</span>
                    <div>
                        <div class="font-bold text-xl mb-2">Waiting for Approval!</div>
                        <div class="font-semibold">Your booking is being reviewed. You'll be notified soon! 📧</div>
                    </div>
                </div>
            </div>
            @endif

            @if($booking->status === 'approved')
            <div class="bg-toca-green border-4 border-gray-800 rounded-toca-xl p-6 mb-6">
                <div class="flex items-start gap-3 text-white">
                    <span class="text-4xl">✅</span>
                    <div>
                        <div class="font-bold text-xl mb-2">Booking Confirmed!</div>
                        <div class="font-semibold">Your tickets are ready! See you at the event! 🎉</div>
                    </div>
                </div>
            </div>
            @endif

            @if($booking->status === 'cancelled')
            <div class="bg-red-500 border-4 border-gray-800 rounded-toca-xl p-6 mb-6">
                <div class="flex items-start gap-3 text-white">
                    <span class="text-4xl">❌</span>
                    <div>
                        <div class="font-bold text-xl mb-2">Booking Cancelled</div>
                        <div class="font-semibold">This booking has been cancelled. 😢</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="flex gap-4">
                <a href="{{ route('user.dashboard') }}" class="toca-btn-outline flex-1 text-center">
                    🏠 Back to Dashboard
                </a>
                
                @if($booking->status === 'pending')
                <form action="{{ route('user.booking.cancel', $booking->id) }}" method="POST" class="flex-1"
                    onsubmit="return confirm('Cancel this booking? 🤔')">
                    @csrf
                    <button type="submit" class="w-full px-6 py-4 rounded-toca font-bold bg-red-500 text-white border-4 border-gray-800 shadow-toca hover:shadow-toca-lg transition-all active:translate-y-1">
                        ❌ Cancel Booking
                    </button>
                </form>
                @endif
            </div>
        </div>

    </div>

</div>
@endsection
