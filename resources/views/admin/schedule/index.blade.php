@extends('layout.dashboard')

@section('content')
    <h1>Manage Schedule</h1>

    <a href="{{ route('schedule.create') }}">+ Tambah Jadwal</a>

    <hr>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

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
                        {{ $schedule->origin->name }} →
                        {{ $schedule->destination->name }}
                    </td>

                    <td>{{ $schedule->departure_time }}</td>
                    <td>{{ $schedule->arrival_time }}</td>

                    <td>Rp {{ number_format($schedule->price) }}</td>
                    <td>{{ $schedule->available_seats }}</td>

                    <td>
                        <a href="{{ route('schedule.edit', $schedule->id) }}">Edit</a>

                        <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    {{-- {{ $schedules->links() }} --}}
@endsection
