<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $organizerId = auth()->id();

        $bookings = Booking::with(['user', 'ticket.event'])
            ->whereHas('ticket.event', function ($q) use ($organizerId) {
                $q->where('user_id', $organizerId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('organizer.bookings.index', compact('bookings'));
    }

    public function approve(Booking $booking)
    {
        $this->authorizeBooking($booking);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking already processed.');
        }

        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Booking approved!');
    }

    public function cancel(Booking $booking)
    {
        $this->authorizeBooking($booking);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking already processed.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled!');
    }

    protected function authorizeBooking(Booking $booking)
    {
        $organizerId = auth()->id();

        if ($booking->ticket->event->user_id !== $organizerId) {
            abort(403, 'Unauthorized action.');
        }
    }
}
