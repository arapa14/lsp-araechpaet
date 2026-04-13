@extends('layout.dashboard')

@section('content')

    <h1>Booking Ticket</h1>

    <hr>

    <h2>Flight Detail</h2>

    <p><strong>Airline:</strong> {{ $schedule->plane->airline->name }}</p>
    <p><strong>Plane:</strong> {{ $schedule->plane->name }}</p>
    <p>
        <strong>Route:</strong>
        {{ $schedule->origin->name }} → {{ $schedule->destination->name }}
    </p>
    <p>
        <strong>Departure:</strong>
        {{ \Carbon\Carbon::parse($schedule->departure_time)->format('d M Y H:i') }}
    </p>
    <p>
        <strong>Arrival:</strong>
        {{ \Carbon\Carbon::parse($schedule->arrival_time)->format('d M Y H:i') }}
    </p>
    <p><strong>Price per Ticket:</strong> Rp {{ number_format($schedule->price) }}</p>
    <p><strong>Available Seats:</strong> {{ $schedule->available_seats }}</p>

    <hr>

    @if (session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('customer.booking.store') }}" method="POST">
        @csrf

        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

        <h3>Jumlah Tiket</h3>
        <input type="number" name="qty" min="1" max="{{ $schedule->available_seats }}" value="1" required>

        <br><br>

        <p>
            <strong>Estimasi Total:</strong>
            Rp <span id="total">{{ number_format($schedule->price) }}</span>
        </p>

        <hr>

        <h3>Pilih Metode Pembayaran</h3>

        @foreach ($payments as $payment)
            <label>
                <input type="radio" name="payment_id" value="{{ $payment->id }}" required>
                {{ $payment->name }}

                @if ($payment->no)
                    ({{ $payment->no }})
                @endif
            </label>
            <br>
        @endforeach

        <br>

        <button type="submit">Konfirmasi Booking</button>

    </form>

    <script>
        const price = {{ $schedule->price }};
        const qtyInput = document.querySelector('input[name="qty"]');
        const totalEl = document.getElementById('total');

        qtyInput.addEventListener('input', function() {
            let qty = this.value || 1;
            let total = price * qty;

            totalEl.innerText = total.toLocaleString('id-ID');
        });
    </script>
@endsection
