@extends('layout.dashboard')

@section('content')
    <h1>Manage Schedule</h1>

    <!-- ACTION BAR -->
    <div style="margin-bottom:16px;">
        <a href="{{ route('schedule.create') }}">
            <button>+ Tambah Jadwal</button>
        </a>
    </div>

    <!-- SUCCESS -->
    @if (session('success'))
        <div class="card" style="background:#ecfdf5; color:#065f46;">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Airline</th>
                    <th>Plane</th>
                    <th>Route</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Price</th>
                    <th>Seats</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->plane->airline->name }}</td>

                        <td>{{ $schedule->plane->name }}</td>

                        <td>
                            {{ $schedule->origin->name }}
                            →
                            {{ $schedule->destination->name }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($schedule->departure_time)->format('d M Y H:i') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($schedule->arrival_time)->format('d M Y H:i') }}
                        </td>

                        <td>
                            Rp {{ number_format($schedule->price) }}
                        </td>

                        <!-- SEATS -->
                        <td>
                            @if ($schedule->available_seats > 10)
                                <span class="badge badge-success">
                                    {{ $schedule->available_seats }}
                                </span>
                            @elseif ($schedule->available_seats > 0)
                                <span class="badge" style="background:#fef9c3; color:#854d0e;">
                                    {{ $schedule->available_seats }}
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Full
                                </span>
                            @endif
                        </td>

                        <!-- ACTION -->
                        <td style="display:flex; gap:8px;">
                            <a href="{{ route('schedule.edit', $schedule->id) }}">
                                <button>Edit</button>
                            </a>

                            <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" style="background:#ef4444;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty">
                            Tidak ada data schedule
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION (optional) -->
    {{-- <div style="margin-top:20px;">
    {{ $schedules->links() }}
</div> --}}
@endsection
