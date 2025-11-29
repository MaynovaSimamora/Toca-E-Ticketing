@extends('layouts.app')

@section('title', 'Manage Bookings')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">
        Event Bookings
    </h1>

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

    <div class="toca-card-elegant overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs md:text-sm">
                <thead>
                    <tr class="border-b-2 border-gray-800">
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Event</th>
                        <th class="px-4 py-3 text-left">Ticket</th>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-center">Qty</th>
                        <th class="px-4 py-3 text-right">Total</th>
                        <th class="px-4 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $booking->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $booking->ticket->event->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $booking->ticket->name ?? '-' }}
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

                            <td class="px-4 py-3 text-center">
                                @if($booking->status === 'pending')
                                    <span class="toca-badge-purple text-[11px] md:text-xs px-3 py-1 mr-2">
                                        Pending
                                    </span>

                                    <form action="{{ route('organizer.bookings.approve', $booking->id) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="toca-badge-cute bg-green-500 text-white text-[11px] md:text-xs px-3 py-1">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('organizer.bookings.cancel', $booking->id) }}"
                                          method="POST"
                                          class="inline ml-1">
                                        @csrf
                                        <button type="submit"
                                                class="toca-badge-cute bg-red-500 text-white text-[11px] md:text-xs px-3 py-1">
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
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                Belum ada booking untuk event Anda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
