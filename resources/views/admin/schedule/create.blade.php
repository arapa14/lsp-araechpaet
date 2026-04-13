@extends('layout.dashboard')

@section('content')

    <h1>Tambah Schedule</h1>

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

        <form action="{{ route('schedule.store') }}" method="POST">
            @csrf

            <!-- PLANE -->
            <div class="form-group">
                <label>Plane</label>
                <select name="plane_id" required>
                    @foreach ($planes as $plane)
                        <option value="{{ $plane->id }}">
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
                        <option value="{{ $city->id }}">
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
                        <option value="{{ $city->id }}">
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- DEPARTURE -->
            <div class="form-group">
                <label>Departure Time</label>
                <input type="datetime-local" name="departure_time" required>
            </div>

            <!-- ARRIVAL -->
            <div class="form-group">
                <label>Arrival Time</label>
                <input type="datetime-local" name="arrival_time" required>
            </div>

            <!-- PRICE -->
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" placeholder="Contoh: 500000" required>
            </div>

            <!-- SEATS -->
            <div class="form-group">
                <label>Available Seats</label>
                <input type="number" name="available_seats" placeholder="Contoh: 120" required>
            </div>

            <!-- ACTION -->
            <div style="margin-top:16px;">
                <button type="submit">Simpan</button>
                <a href="{{ route('schedule.index') }}">
                    <button type="button" style="background:#e2e8f0; color:black;">
                        Kembali
                    </button>
                </a>
            </div>

        </form>

    </div>

@endsection
