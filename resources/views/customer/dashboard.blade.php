@extends('layout.dashboard')

@section('content')
    <h1>Customer Dashboard</h1>

    <!-- FILTER -->
    <div class="card">
        <form method="GET" action="{{ route('dashboard') }}">
            <label>From:</label>
            <select name="origin_id">
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>

            <label>To:</label>
            <select name="destination_id">
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>

            <label>Date:</label>
            <input type="date" name="date">

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
    </div>
@endsection
