@extends('layouts.app')

@php
    $backgroundImage = 'admin.jpg';
@endphp

@section('title', 'Admin Dashboard')

@section('content')
<div class="relative overflow-hidden min-h-screen">
    <div class="container mx-auto px-4 py-12">

        {{-- HEADER --}}
        <div class="text-center mb-16">
            <div class="flex justify-center items-center gap-4 mb-6">
                <span class="text-7xl">👑</span>
                <div class="text-center">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-2">
                        Admin Control Center
                    </h1>
                    <p class="text-2xl text-gray-600 font-semibold">
                        Manage everything! 🚀
                    </p>
                </div>
                <span class="text-7xl">⚙️</span>
            </div>
        </div>

        {{-- 1. STATS (4 kartu utama + sales) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-12">

            {{-- Total Users --}}
            <div class="toca-card-elegant p-6 bg-gradient-to-br from-blue-100 to-cyan-100 subtle-hover relative">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-5xl font-bold text-gray-800">
                            {{ $stats['total_users'] }}
                        </div>
                        <div class="text-lg font-bold text-gray-700 mt-2">
                            Total Users
                        </div>
                    </div>
                    <div class="text-6xl">👥</div>
                </div>
                <div class="mt-4 h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500" style="width: 100%"></div>
                </div>
            </div>

            {{-- Organizers --}}
            <div class="toca-card-elegant p-6 bg-gradient-to-br from-purple-100 to-pink-100 subtle-hover relative">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-5xl font-bold text-gray-800">
                            {{ $stats['total_organizers'] }}
                        </div>
                        <div class="text-lg font-bold text-gray-700 mt-2">
                            Organizers
                        </div>
                    </div>
                    <div class="text-6xl">🎨</div>
                </div>
                <div class="mt-4 h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500" style="width: 85%"></div>
                </div>
            </div>

            {{-- Pending organizers --}}
            <div class="toca-card-elegant p-6 bg-gradient-to-br from-yellow-100 to-orange-100 subtle-hover relative">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-5xl font-bold text-gray-800">
                            {{ $stats['pending_organizers'] }}
                        </div>
                        <div class="text-lg font-bold text-gray-700 mt-2">
                            Pending
                        </div>
                    </div>
                    <div class="text-6xl">⏰</div>
                </div>
                <div class="mt-4 h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-500"
                         style="width: {{ $stats['pending_organizers'] > 0 ? '60' : '0' }}%">
                    </div>
                </div>
            </div>

            {{-- Total events --}}
            <div class="toca-card-elegant p-6 bg-gradient-to-br from-green-100 to-emerald-100 subtle-hover relative">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-5xl font-bold text-gray-800">
                            {{ $stats['total_events'] }}
                        </div>
                        <div class="text-lg font-bold text-gray-700 mt-2">
                            Total Events
                        </div>
                    </div>
                    <div class="text-6xl">🎪</div>
                </div>
                <div class="mt-4 h-2 bg-white/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500" style="width: 90%"></div>
                </div>
            </div>

            {{-- Tickets sold + revenue --}}
            <div class="toca-card-elegant p-6 bg-gradient-to-br from-yellow-100 to-orange-100 subtle-hover relative">
                <div class="flex items-start justify-between mb-3">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold text-gray-600 leading-snug">
                            Tickets Sold
                        </p>
                        <p class="text-4xl font-extrabold text-gray-900 leading-tight">
                            {{ $totalTicketsSold }}
                        </p>
                    </div>
                    <span class="text-4xl mt-1">🎫</span>
                </div>

                <div class="space-y-1 mt-2">
                    <p class="text-sm font-semibold text-gray-600 leading-snug">
                        Total Revenue
                    </p>
                    <p class="text-2xl font-extrabold text-toca-pink leading-tight">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- 2. CREATE NEW EVENT CTA --}}
        <div class="toca-card-elegant p-8 bg-gradient-to-r from-pink-100 via-purple-100 to-blue-100 mb-16 text-center subtle-hover relative">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="text-7xl">➕</div>
                    <div class="text-left">
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">
                            Create New Event
                        </h3>
                        <p class="text-lg text-gray-700 font-bold">
                            Admin can create events directly!
                        </p>
                    </div>
                </div>
                <a href="{{ route('admin.events.create') }}"
                   class="toca-btn-pink text-xl px-10">
                    Create Event 🚀
                </a>
            </div>
        </div>

        {{-- 3. RECENT BOOKINGS & STATUS --}}
        <div class="mt-4 mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">
                Recent Bookings & Status
            </h2>

            <div class="toca-card-elegant overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs md:text-sm">
                        <thead>
                            <tr class="border-b-2 border-gray-800">
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-left">Event</th>
                                <th class="px-4 py-3 text-left">User</th>
                                <th class="px-4 py-3 text-center">Qty</th>
                                <th class="px-4 py-3 text-right">Total</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                                <tr class="border-b border-gray-200">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $booking->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $booking->ticket->event->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $booking->user->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        {{ $booking->quantity }}
                                    </td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </td>

                                    {{-- STATUS + ACTION BUTTONS --}}
                                   <td class="px-4 py-3 text-center">
                                        @if($booking->status === 'pending')
                                            <span class="toca-badge-purple text-[11px] md:text-xs px-3 py-1 mr-2">
                                                {{ ucfirst($booking->status) }}
                                            </span>

                                            {{-- Approve --}}
                                            <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="toca-badge-cute bg-green-500 text-white text-[11px] md:text-xs px-3 py-1">
                                                    Approve
                                                </button>
                                            </form>

                                            {{-- Cancel --}}
                                            <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" class="inline ml-1">
                                                @csrf
                                                <button type="submit" class="toca-badge-cute bg-red-500 text-white text-[11px] md:text-xs px-3 py-1">
                                                    Cancel
                                                </button>
                                            </form>
                                        @elseif($booking->status === 'approved')
                                            <span class="toca-badge-cute bg-green-500 text-white text-[11px] md:text-xs px-3 py-1">
                                                Approved
                                            </span>
                                        @else
                                            <span class="toca-badge-cute bg-red-500 text-white text-[11px] md:text-xs px-3 py-1">
                                                Cancelled
                                            </span>
                                        @endif
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                        Belum ada pemesanan tiket.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        {{-- 4. QUICK LINKS (MANAGE USERS / EVENTS) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <a href="{{ route('admin.users.index') }}"
               class="toca-card-elegant p-8 bg-gradient-to-br from-white to-blue-50 subtle-hover relative group">
                <div class="flex items-center gap-6">
                    <div class="text-7xl">👥</div>
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">
                            Manage Users
                        </h3>
                        <p class="text-lg text-gray-600 font-semibold">
                            View & manage all users
                        </p>
                    </div>
                    <div class="ml-auto text-4xl">→</div>
                </div>
            </a>

            <a href="{{ route('admin.events.index') }}"
               class="toca-card-elegant p-8 bg-gradient-to-br from-white to-purple-50 subtle-hover relative group">
                <div class="flex items-center gap-6">
                    <div class="text-7xl">🎪</div>
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">
                            Manage Events
                        </h3>
                        <p class="text-lg text-gray-600 font-semibold">
                            View & manage all events
                        </p>
                    </div>
                    <div class="ml-auto text-4xl">→</div>
                </div>
            </a>
        </div>

        {{-- 5. PENDING APPROVALS (JIKA ADA) --}}
        @if($pendingOrganizers->count() > 0)
            <div class="mb-12">
                <div class="flex items-center gap-4 mb-8">
                    <span class="text-5xl">⏰</span>
                    <h2 class="text-4xl font-bold text-gray-800">Pending Approvals</h2>
                    <span class="toca-badge-elegant bg-red-500 text-white text-xl px-6 py-3">
                        {{ $pendingOrganizers->count() }} New!
                    </span>
                </div>

                <div class="space-y-4">
                    @foreach($pendingOrganizers as $organizer)
                        <div class="toca-card-elegant p-6 bg-gradient-to-br from-yellow-100 to-orange-100 relative">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                                <div class="flex items-center gap-6 flex-1">
                                    <div class="text-5xl">👤</div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                            {{ $organizer->name }}
                                        </h3>
                                        <div class="space-y-1 text-gray-700 font-bold">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xl">📧</span>
                                                <span>{{ $organizer->email }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xl">📅</span>
                                                <span class="text-sm">
                                                    Registered: {{ $organizer->created_at->format('d M Y, H:i') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <form action="{{ route('admin.users.approve', $organizer->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="toca-btn-elegant bg-green-500 text-white px-8 py-4 text-lg font-bold">
                                            ✅ Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.users.reject', $organizer->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Reject this organizer? 🤔')">
                                        @csrf
                                        <button type="submit"
                                                class="toca-btn-elegant bg-red-500 text-white px-8 py-4 text-lg font-bold">
                                            ❌ Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- 6. RECENT EVENTS --}}
        <div class="mb-4">
            <div class="flex items-center gap-4 mb-8">
                <span class="text-5xl">🎪</span>
                <h2 class="text-4xl font-bold text-gray-800">Recent Events</h2>
            </div>

            @if($recentEvents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentEvents as $event)
                        <div class="toca-card-elegant overflow-hidden bg-white relative subtle-hover">
                            <div class="relative h-48 overflow-hidden">
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

                            <div class="p-5 bg-gradient-to-br from-white to-purple-50">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">
                                    {{ $event->name }}
                                </h3>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                        <span class="text-xl">🎨</span>
                                        <span>by {{ $event->user->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                        <span class="text-xl">📅</span>
                                        <span>{{ $event->event_date->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                        <span class="text-xl">📍</span>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('event.show', $event->id) }}"
                                   class="block text-center toca-btn-blue py-2 text-sm">
                                    View Event 👁️
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="toca-card-elegant p-16 bg-gradient-to-br from-white to-blue-50 text-center relative">
                    <div class="text-8xl mb-6">🎪</div>
                    <h3 class="text-3xl font-bold text-gray-800">No Events Yet!</h3>
                    <p class="text-lg text-gray-600 font-bold mt-2">
                        Events will appear here once organizers start creating them! 📊
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
