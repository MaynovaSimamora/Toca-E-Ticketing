@extends('layouts.app')

@section('title', 'Ticket Reports')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-4">Ticket Sales Report</h1>

    <p class="mb-4">Total tickets: {{ $totalTickets }}</p>
    <p class="mb-8">Total revenue: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>

    <table class="w-full text-sm border">
        <thead>
            <tr class="border-b">
                <th class="p-2 text-left">Date</th>
                <th class="p-2 text-left">User</th>
                <th class="p-2 text-left">Ticket</th>
                <th class="p-2 text-center">Qty</th>
                <th class="p-2 text-right">Total</th>
                <th class="p-2 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr class="border-b">
                    <td class="p-2">{{ $booking->created_at }}</td>
                    <td class="p-2">{{ $booking->user->name ?? '-' }}</td>
                    <td class="p-2">{{ $booking->ticket->name ?? '-' }}</td>
                    <td class="p-2 text-center">{{ $booking->quantity }}</td>
                    <td class="p-2 text-right">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </td>
                    <td class="p-2 text-center">{{ $booking->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
