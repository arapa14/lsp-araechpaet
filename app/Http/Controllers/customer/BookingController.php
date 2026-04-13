<?php

namespace App\Http\Controllers\customer;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'qty' => 'required|integer|min:1',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $schedule = Schedule::lockForUpdate()->findOrFail($request->schedule_id);

            // Cek seat cukup
            if ($request->qty > $schedule->available_seats) {
                return back()->with('error', 'Seat tidak cukup');
            }

            // Upload bukti pembayaran
            $paymentProofPath = $request->file('payment_proof')
                ->store('payment_proofs', 'public');

            $total = $schedule->price * $request->qty;

            Booking::create([
                'user_id' => Auth::id(),
                'schedule_id' => $schedule->id,
                'payment_id' => $request->payment_id,
                'code' => 'BOOK-' . strtoupper(uniqid()),
                'quantity' => $request->qty,
                'total_price' => $total,
                'payment_proof' => $paymentProofPath,
            ]);

            // Kurangi seat
            $schedule->decrement('available_seats', $request->qty);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', 'Booking berhasil, menunggu verifikasi!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
