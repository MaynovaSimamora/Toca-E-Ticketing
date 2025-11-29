<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function approve(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking already processed.');
        }

        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Booking approved!');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking already processed.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled!');
    }
}
