@extends('layout.dashboard')

@section('content')
    <h1>Welcome {{ Auth::user()->name }}</h1>

    <!-- FILTER -->
    <div class="card">
        <form method="GET" action="{{ route('dashboard') }}">
            <label>Search:</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Airline / Plane">

            <label>From:</label>
            <select name="origin_id">
                <option value="">All</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ request('origin_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>

            <label>To:</label>
            <select name="destination_id">
                <option value="">All</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ request('destination_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>

            <label>Date:</label>
            <input type="date" name="date" value="{{ request('date') }}">

            <button type="submit">Search</button>
        </form>
    </div>

    <!-- LIST -->
    <div class="card">
        <h2>Available Flights</h2>

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
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset('storage/' . $schedule->plane->airline->logo) }}" alt="logo"
                                    width="40">
                                {{ $schedule->plane->airline->name }}
                            </div>
                        </td>
                        <td>{{ $schedule->plane->name }}</td>
                        <td>
                            {{ $schedule->origin->name }} → {{ $schedule->destination->name }}
                        </td>
                        <td>{{ $schedule->departure_time }}</td>
                        <td>{{ $schedule->arrival_time }}</td>
                        <td>Rp {{ number_format($schedule->price) }}</td>

                        <td>
                            @if ($schedule->available_seats > 0)
                                <span class="badge badge-success">
                                    {{ $schedule->available_seats }} seats
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Full
                                </span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('customer.booking.index', $schedule->id) }}">
                                <button>Pesan</button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty">
                            Tidak ada jadwal tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
    </div>
@endsection
