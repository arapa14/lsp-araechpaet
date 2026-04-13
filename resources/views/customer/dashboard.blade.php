@extends('layout.dashboard')

@section('content')
    <h1>Customer Dashboard</h1>

    <!-- Filter (optional tapi best practice) -->
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

    <hr>

    <!-- List Jadwal -->
    <h2>Available Flights</h2>

    <table border="1" cellpadding="10">
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
                        {{ $schedule->origin->name }} → {{ $schedule->destination->name }}
                    </td>
                    <td>{{ $schedule->departure_time }}</td>
                    <td>{{ $schedule->arrival_time }}</td>
                    <td>Rp {{ number_format($schedule->price) }}</td>
                    <td>{{ $schedule->available_seats }}</td>
                    <td>
                        <a href="{{ route('customer.booking.index', $schedule->id) }}">
                            <button>Pesan</button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada jadwal tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
