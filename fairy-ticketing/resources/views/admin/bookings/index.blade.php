@extends('layouts.app')

@section('title', 'Recent Bookings')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-6">Recent Bookings</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 font-semibold rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 font-semibold rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto toca-card p-6 bg-white">
        <table class="min-w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-3 font-bold">Customer</th>
                    <th class="px-4 py-3 font-bold">Event</th>
                    <th class="px-4 py-3 font-bold">Ticket</th>
                    <th class="px-4 py-3 font-bold">Qty</th>
                    <th class="px-4 py-3 font-bold">Total</th>
                    <th class="px-4 py-3 font-bold">Status</th>
                    <th class="px-4 py-3 font-bold">Date</th>
                    <th class="px-4 py-3 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold">
                            {{ $booking->user->name }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $booking->ticket->event->name }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $booking->ticket->name }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $booking->quantity }}
                        </td>
                        <td class="px-4 py-3 font-bold">
                            Rp {{ number_format($booking->total, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">
                            @if($booking->status === 'pending')
                                <span class="toca-badge-cute bg-yellow-400 text-white">
                                    Pending
                                </span>
                            @elseif($booking->status === 'approved')
                                <span class="toca-badge-cute bg-green-500 text-white">
                                    Approved
                                </span>
                            @else
                                <span class="toca-badge-cute bg-red-500 text-white">
                                    Cancelled
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            {{ $booking->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            @if($booking->status === 'pending')
                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="toca-badge-cute bg-green-500 text-white">
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    <button type="submit" class="toca-badge-cute bg-red-500 text-white">
                                        Cancel
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-sm">No actions</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                            No bookings yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection
