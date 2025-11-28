<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class ReportController extends Controller
{
    public function sales()
    {
        // daftar semua booking + relasi user dan event
        $bookings = Booking::with(['user', 'ticket.event'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // ringkasan penjualan
        $totalTickets = Booking::sum('quantity');
        $totalRevenue = Booking::sum('total_price');

        return view('admin.reports.sales', compact('bookings', 'totalTickets', 'totalRevenue'));
    }
}
