<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_organizers' => User::where('role', 'organizer')->count(),
            'pending_organizers' => User::where('role', 'organizer')
                ->where('status', 'pending')->count(),
            'total_events' => Event::count(),
            'total_bookings' => Booking::count(),
        ];

        $pendingOrganizers = User::where('role', 'organizer')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $recentEvents = Event::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendingOrganizers', 'recentEvents'));
    }
}
