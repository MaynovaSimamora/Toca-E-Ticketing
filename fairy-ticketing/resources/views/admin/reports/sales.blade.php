@extends('layouts.app')

@section('title', 'Ticket Sales Report')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-6">Ticket Sales & Bookings</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="toca-card p-6">
            <p class="text-gray-600 text-sm">Total Tickets Sold</p>
            <p class="text-3xl font-bold">{{ $totalTickets }}</p>
        </div>
        <div class="toca-card p-6">
            <p class="text-gray-600 text-sm">Total Revenue</p>
            <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="toca-card p-6">
        <h2 class="text-2xl font-bold mb-4">Bookings Detail</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b-2 border-gray-800">
                        <th class="py-3 px-4 text-left">Date</th>
                        <th class="py-3 px-4 text-left">Event</th>
                        <th class="py-3 px-4 text-left">Ticket</th>
                        <th class="py-3 px-4 text-left">Buyer</th>
                        <th class="py-3 px-4 text-center">Qty</th>
                        <th class="py-3 px-4 text-right">Total</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 px-4">
                                {{ $booking->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="py-2 px-4">
                                {{ $booking->ticket->event->name ?? '-' }}
                            </td>
                            <td class="py-2 px-4">
                                {{ $booking->ticket->name ?? '-' }}
                            </td>
                            <td class="py-2 px-4">
                                {{ $booking->user->name ?? '-' }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                {{ $booking->quantity }}
                            </td>
                            <td class="py-2 px-4 text-right">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                <span class="toca-badge-purple text-xs">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500">
                                Belum ada pemesanan tiket.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection
