@extends('layout.dashboard')

@section('content')

    <h1>Edit Schedule</h1>

    <a href="{{ route('schedule.index') }}">← Kembali</a>

    <hr>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Plane -->
        <label>Plane:</label>
        <select name="plane_id">
            @foreach ($planes as $plane)
                <option value="{{ $plane->id }}" {{ $schedule->plane_id == $plane->id ? 'selected' : '' }}>
                    {{ $plane->airline->name }} - {{ $plane->name }}
                </option>
            @endforeach
        </select>

        <br>

        <!-- Origin -->
        <label>Origin:</label>
        <select name="origin_id">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ $schedule->origin_id == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>

        <br>

        <!-- Destination -->
        <label>Destination:</label>
        <select name="destination_id">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ $schedule->destination_id == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>

        <br>

        <!-- Departure -->
        <label>Departure:</label>
        <input type="datetime-local" name="departure_time"
            value="{{ \Carbon\Carbon::parse($schedule->departure_time)->format('Y-m-d\TH:i') }}">

        <br>

        <!-- Arrival -->
        <label>Arrival:</label>
        <input type="datetime-local" name="arrival_time"
            value="{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('Y-m-d\TH:i') }}">

        <br>

        <!-- Price -->
        <label>Price:</label>
        <input type="number" name="price" value="{{ $schedule->price }}">

        <br>

        <!-- Seats -->
        <label>Seats:</label>
        <input type="number" name="available_seats" value="{{ $schedule->available_seats }}">

        <br><br>

        <button type="submit">Update</button>

    </form>

@endsection
