@extends('layout.dashboard')

@section('content')
    <h1>Tambah Schedule</h1>

    <form action="{{ route('schedule.store') }}" method="POST">
        @csrf

        <label>Plane:</label>
        <select name="plane_id">
            @foreach ($planes as $plane)
                <option value="{{ $plane->id }}">
                    {{ $plane->airline->name }} - {{ $plane->name }}
                </option>
            @endforeach
        </select>

        <br>

        <label>Origin:</label>
        <select name="origin_id">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>

        <br>

        <label>Destination:</label>
        <select name="destination_id">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>

        <br>

        <label>Departure:</label>
        <input type="datetime-local" name="departure_time">

        <br>

        <label>Arrival:</label>
        <input type="datetime-local" name="arrival_time">

        <br>

        <label>Price:</label>
        <input type="number" name="price">

        <br>

        <label>Seats:</label>
        <input type="number" name="available_seats">

        <br><br>

        <button type="submit">Save</button>

    </form>
@endsection
