@extends('layout.dashboard')

@section('content')

    <h1>Edit Schedule</h1>

    <!-- BACK BUTTON -->
    <div style="margin-bottom:16px;">
        <a href="{{ route('schedule.index') }}">
            <button type="button" style="background:#e2e8f0; color:black;">
                ← Kembali
            </button>
        </a>
    </div>

    <!-- ERROR -->
    @if ($errors->any())
        <div class="card" style="background:#fee2e2; color:#991b1b;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">

        <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- PLANE -->
            <div class="form-group">
                <label>Plane</label>
                <select name="plane_id" required>
                    @foreach ($planes as $plane)
                        <option value="{{ $plane->id }}" {{ $schedule->plane_id == $plane->id ? 'selected' : '' }}>
                            {{ $plane->airline->name }} - {{ $plane->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- ORIGIN -->
            <div class="form-group">
                <label>Origin</label>
                <select name="origin_id" required>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $schedule->origin_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- DESTINATION -->
            <div class="form-group">
                <label>Destination</label>
                <select name="destination_id" required>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}"
                            {{ $schedule->destination_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- DEPARTURE -->
            <div class="form-group">
                <label>Departure Time</label>
                <input type="datetime-local" name="departure_time"
                    value="{{ \Carbon\Carbon::parse($schedule->departure_time)->format('Y-m-d\TH:i') }}" required>
            </div>

            <!-- ARRIVAL -->
            <div class="form-group">
                <label>Arrival Time</label>
                <input type="datetime-local" name="arrival_time"
                    value="{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('Y-m-d\TH:i') }}" required>
            </div>

            <!-- PRICE -->
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" value="{{ $schedule->price }}" required>
            </div>

            <!-- SEATS -->
            <div class="form-group">
                <label>Available Seats</label>
                <input type="number" name="available_seats" value="{{ $schedule->available_seats }}" required>
            </div>

            <!-- ACTION -->
            <div style="margin-top:16px;">
                <button type="submit">Update</button>

                <a href="{{ route('schedule.index') }}">
                    <button type="button" style="background:#e2e8f0; color:black;">
                        Batal
                    </button>
                </a>
            </div>

        </form>

    </div>

@endsection
