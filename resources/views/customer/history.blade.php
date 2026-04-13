@extends('layout.dashboard')

@section('content')
    <h1>Riwayat Booking</h1>

    <hr>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Airline</th>
                <th>Rute</th>
                <th>Jadwal</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->code }}</td>

                    <td>
                        {{ $booking->schedule->plane->airline->name }}
                    </td>

                    <td>
                        {{ $booking->schedule->origin->name }}
                        →
                        {{ $booking->schedule->destination->name }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('d M Y H:i') }}
                    </td>

                    <td>
                        {{ $booking->quantity }}
                    </td>

                    <td>
                        Rp {{ number_format($booking->total_price) }}
                    </td>

                    <td>
                        {{ $booking->payment->name }}
                    </td>

                    <td>
                        {{ ucfirst($booking->status) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada booking</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <!-- Pagination -->
    {{ $bookings->links() }}
@endsection
