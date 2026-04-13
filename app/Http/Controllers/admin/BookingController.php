<?php

namespace App\Http\Controllers\admin;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController
{
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();
        return back()->with('success', 'Status updated');
    }
}
