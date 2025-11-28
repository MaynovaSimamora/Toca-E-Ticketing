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
        // angka ringkasan untuk kartu stats
        $stats = [
            'total_users'        => User::count(),
            'total_organizers'   => User::where('role', 'organizer')->count(),
            'pending_organizers' => User::where('role', 'organizer')
                                        ->where('status', 'pending')
                                        ->count(),
            'total_events'       => Event::count(),
        ];

        // ringkasan penjualan tiket
        $totalTicketsSold = Booking::sum('quantity');
        $totalRevenue     = Booking::sum('total_price');

        // daftar booking terbaru (untuk tabel “Recent Bookings & Status”)
        $recentBookings = Booking::with(['user', 'ticket.event'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // daftar organizer pending (section Pending Approvals)
        $pendingOrganizers = User::where('role', 'organizer')
            ->where('status', 'pending')
            ->get();

        // recent events (section Recent Events)
        $recentEvents = Event::with('user')
            ->orderBy('event_date', 'desc')
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'totalTicketsSold',
            'totalRevenue',
            'recentBookings',
            'pendingOrganizers',
            'recentEvents'
        ));
    }
}
