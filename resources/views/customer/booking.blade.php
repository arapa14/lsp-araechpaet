@extends('layout.dashboard')

@section('content')

    <h1>Booking Ticket</h1>

    <!-- FLIGHT DETAIL -->
    <div class="card">
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

        <p><strong>Price:</strong> Rp {{ number_format($schedule->price) }} / ticket</p>

        <p>
            <strong>Seats:</strong>
            @if ($schedule->available_seats > 0)
                <span class="badge badge-success">
                    {{ $schedule->available_seats }} tersedia
                </span>
            @else
                <span class="badge badge-danger">Full</span>
            @endif
        </p>
    </div>

    <!-- ERROR -->
    @if (session('error'))
        <div class="card" style="background:#fee2e2; color:#991b1b;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="card" style="background:#fee2e2; color:#991b1b;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM BOOKING -->
    <div class="card">
        <form action="{{ route('customer.booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

            <!-- QTY -->
            <div class="form-group">
                <label>Jumlah Tiket</label>
                <input type="number" name="qty" min="1" max="{{ $schedule->available_seats }}" value="1"
                    required style="padding:8px; border-radius:6px; border:1px solid #cbd5e1;">
            </div>

            <!-- TOTAL -->
            <div class="card" style="background:#f8fafc;">
                <p>
                    <strong>Estimasi Total:</strong><br>
                    <span style="font-size:20px; font-weight:bold;">
                        Rp <span id="total">{{ number_format($schedule->price) }}</span>
                    </span>
                </p>
            </div>

            <!-- PAYMENT -->
            <div class="form-group">
                <label>Pilih Metode Pembayaran</label>

                @foreach ($payments as $payment)
                    <label style="display:flex; align-items:center; gap:10px; margin-top:8px;">
                        <input type="radio" name="payment_id" value="{{ $payment->id }}" required>

                        <img src="{{ $payment->logo ? asset('storage/' . $payment->logo) : asset('images/default-payment.png') }}"
                            alt="logo" width="40">

                        <div>
                            {{ $payment->name }}
                            @if ($payment->no)
                                <div style="font-size:12px; color:gray;">
                                    {{ $payment->no }}
                                </div>
                            @endif
                        </div>
                    </label>
                @endforeach
            </div>

            <div class="form-group">
                <label>Upload Bukti Pembayaran</label>
                <input type="file" name="payment_proof" accept="image/*" required
                    style="padding:8px; border-radius:6px; border:1px solid #cbd5e1;">
            </div>

            <br>

            <button type="submit">Konfirmasi Booking</button>
        </form>
    </div>

    <!-- SCRIPT -->
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
