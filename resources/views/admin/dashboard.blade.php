@extends('layout.dashboard')

@section('content')
    <h1>Admin Dashboard</h1>

    <hr>

    <h2>Semua Booking</h2>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Kode</th>
                <th>User</th>
                <th>Airline</th>
                <th>Rute</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->code }}</td>

                    <td>{{ $booking->user->name }}</td>

                    <td>
                        {{ $booking->schedule->plane->airline->name }}
                    </td>

                    <td>
                        {{ $booking->schedule->origin->name }}
                        →
                        {{ $booking->schedule->destination->name }}
                    </td>

                    <td>{{ $booking->quantity }}</td>

                    <td>Rp {{ number_format($booking->total_price) }}</td>

                    <td>{{ $booking->payment->name }}</td>

                    <td>{{ ucfirst($booking->status) }}</td>

                    <td>
                        <form action="{{ route('admin.booking.updateStatus', $booking->id) }}" method="POST">
                            @csrf

                            <select name="status">
                                <option value="pending">Pending</option>
                                <option value="success">Success</option>
                                <option value="failed">Failed</option>
                                <option value="canceled">Canceled</option>
                            </select>

                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Tidak ada booking</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    {{ $bookings->links() }}
@endsection
