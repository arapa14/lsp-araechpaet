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

    <div class="card" style="margin-bottom:16px;">
        <form method="GET" action="{{ route('schedule.index') }}" style="display:flex; gap:10px; flex-wrap:wrap;">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Airline / Plane">

            <select name="origin_id">
                <option value="">From</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ request('origin_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>

            <select name="destination_id">
                <option value="">To</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ request('destination_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ request('date') }}">

            <button type="submit">Filter</button>
        </form>
    </div>

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

    <div style="margin-top:20px; text-align:center;">
        @if ($schedules->onFirstPage())
            <span>«</span>
        @else
            <a href="{{ $schedules->previousPageUrl() }}">«</a>
        @endif

        Page {{ $schedules->currentPage() }} / {{ $schedules->lastPage() }}

        @if ($schedules->hasMorePages())
            <a href="{{ $schedules->nextPageUrl() }}">»</a>
        @else
            <span>»</span>
        @endif
    </div>
@endsection
