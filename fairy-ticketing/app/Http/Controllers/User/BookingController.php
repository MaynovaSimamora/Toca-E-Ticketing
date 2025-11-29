<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

        if ($ticket->quantity < $request->quantity) {
            return back()->with('error', 'Not enough tickets available!');
        }

        DB::transaction(function() use ($request, $ticket) {
            // Create booking
            Booking::create([
                'user_id' => auth()->id(),
                'ticket_id' => $request->ticket_id,
                'quantity' => $request->quantity,
                'total_price' => $ticket->price * $request->quantity,
                'status' => 'pending',
            ]);

            // Reduce ticket quota
            $ticket->decrement('quantity', $request->quantity);
        });

        return redirect()->route('user.dashboard')
            ->with('success', 'Booking created successfully! Waiting for approval.');
    }

    public function cancel($id)
    {
        $booking = Booking::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be cancelled!');
        }

        DB::transaction(function() use ($booking) {
            // Return ticket quota
            $booking->ticket->increment('available', $booking->quantity);

            // Update booking status
            $booking->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);
        });

        return back()->with('success', 'Booking cancelled successfully!');
    }

    public function show($id)
    {
        $booking = Booking::with(['ticket.event'])
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('user.booking-detail', compact('booking'));
    }
}
