<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class ReportController extends Controller
{
    public function sales()
    {
        $bookings = Booking::with(['user', 'ticket'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalTickets = Booking::sum('quantity');
        $totalRevenue = Booking::sum('total_price');

        return view('admin.reports.sales', compact('bookings', 'totalTickets', 'totalRevenue'));
    }
}
