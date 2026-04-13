<?php

namespace App\Http\Controllers\customer;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class HistoryController
{
    public function index()
    {
        $bookings = Booking::with([
            'schedule.plane.airline',
            'schedule.origin',
            'schedule.destination',
            'payment'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

        return view('customer.history', compact('bookings'));
    }
}