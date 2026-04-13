@extends('layout.dashboard')

@section('content')
    <h1>Admin Dashboard</h1>

    <!-- SUCCESS -->
    @if (session('success'))
        <div class="card" style="background:#ecfdf5; color:#065f46;">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="card">
        <h2>Semua Booking</h2>

        <table>
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
                        <td><strong>{{ $booking->code }}</strong></td>

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

                        <!-- STATUS -->
                        <td>
                            @if ($booking->status === 'success')
                                <span class="badge badge-success">Success</span>
                            @elseif ($booking->status === 'pending')
                                <span class="badge" style="background:#fef9c3; color:#854d0e;">Pending</span>
                            @elseif ($booking->status === 'failed')
                                <span class="badge badge-danger">Failed</span>
                            @else
                                <span class="badge" style="background:#e2e8f0;">Canceled</span>
                            @endif
                        </td>

                        <!-- ACTION -->
                        <td>
                            <form action="{{ route('admin.booking.updateStatus', $booking->id) }}" method="POST"
                                style="display:flex; gap:6px;">
                                @csrf

                                <select name="status" style="padding:6px; border-radius:6px;">
                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="success" {{ $booking->status == 'success' ? 'selected' : '' }}>Success
                                    </option>
                                    <option value="failed" {{ $booking->status == 'failed' ? 'selected' : '' }}>Failed
                                    </option>
                                    <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>
                                        Canceled</option>
                                </select>

                                <button type="submit">Update</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty">
                            Tidak ada booking
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div style="margin-top:20px;">
        {{ $bookings->links() }}
    </div>
@endsection
