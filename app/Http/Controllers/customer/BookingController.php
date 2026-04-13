<?php

namespace App\Http\Controllers\customer;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController
{
    public function index($id)
    {
        $schedule = Schedule::with([
            'plane.airline',
            'origin',
            'destination',
            'plane.seats'
        ])->findOrFail($id);

        $payments = Payment::all();

        return view('customer.booking', compact('schedule', 'payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'payment_id' => 'required|exists:payments,id',
            'qty' => 'required|integer|min:1'
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);

        // Cek seat cukup
        if ($request->qty > $schedule->available_seats) {
            return back()->with('error', 'Seat tidak cukup');
        }

        $total = $schedule->price * $request->qty;

        Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'payment_id' => $request->payment_id,
            'code' => 'BOOK-' . strtoupper(uniqid()),
            'quantity' => $request->qty,
            'total_price' => $total,
        ]);

        // Kurangi seat
        $schedule->decrement('available_seats', $request->qty);

        return redirect()->route('dashboard')
            ->with('success', 'Successfully booked');
    }
}
