<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Favorite;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['ticket.event'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $favorites = Favorite::with('event')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('user.dashboard', compact('bookings', 'favorites'));
    }
}
