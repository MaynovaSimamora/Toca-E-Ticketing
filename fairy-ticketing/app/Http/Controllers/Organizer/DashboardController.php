<?php
namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->id())
            ->withCount('tickets')
            ->orderBy('event_date', 'desc')
            ->paginate(10);

        $bookings = Booking::whereHas('ticket.event', function($q) {
            $q->where('user_id', auth()->id());
        })->with(['user', 'ticket.event'])
          ->orderBy('created_at', 'desc')
          ->paginate(10);

        return view('organizer.dashboard', compact('events', 'bookings'));
    }
}
