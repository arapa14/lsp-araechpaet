@extends('layout.dashboard')

@section('content')
    <div class="form-container">
        <div class="form-header">
            <div class="header-title">
                <h1>Tambah Jadwal Penerbangan</h1>
                <p>Lengkapi formulir di bawah untuk menambahkan rute penerbangan baru.</p>
            </div>
            <a href="{{ route('schedule.index') }}" class="btn-back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert-danger">
                <div class="alert-icon">!</div>
                <ul class="alert-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('schedule.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="form-section">
                        <label class="label-group">
                            <span class="label-text">Maskapai & Pesawat</span>
                            <select name="plane_id" class="form-input" required>
                                <option value="" disabled selected>Pilih unit pesawat</option>
                                @foreach ($planes as $plane)
                                    <option value="{{ $plane->id }}">
                                        {{ $plane->airline->name }} — {{ $plane->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>

                        <label class="label-group">
                            <span class="label-text">Harga Tiket (IDR)</span>
                            <div class="input-with-icon">
                                <span class="input-prefix">Rp</span>
                                <input type="number" name="price" placeholder="750.000" class="form-input" required>
                            </div>
                        </label>

                        <label class="label-group">
                            <span class="label-text">Kapasitas Kursi</span>
                            <input type="number" name="available_seats" placeholder="Contoh: 180" class="form-input"
                                required>
                        </label>
                    </div>

                    <div class="form-section">
                        <div class="route-group">
                            <label class="label-group">
                                <span class="label-text">Dari (Origin)</span>
                                <select name="origin_id" class="form-input" required>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <label class="label-group">
                                <span class="label-text">Ke (Destination)</span>
                                <select name="destination_id" class="form-input" required>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <label class="label-group">
                            <span class="label-text">Waktu Keberangkatan</span>
                            <input type="datetime-local" name="departure_time" class="form-input" required>
                        </label>

                        <label class="label-group">
                            <span class="label-text">Waktu Kedatangan</span>
                            <input type="datetime-local" name="arrival_time" class="form-input" required>
                        </label>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="reset" class="btn-reset">Reset Form</button>
                    <button type="submit" class="btn-submit">Simpan Jadwal Baru</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-body: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        .form-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .header-title h1 {
            font-size: 1.75rem;
            color: var(--text-main);
            margin: 0 0 0.5rem 0;
        }

        .header-title p {
            color: var(--text-muted);
            margin: 0;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: var(--primary);
        }

        .form-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 2rem;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .label-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .label-text {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .form-input {
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #fcfcfd;
            font-size: 0.95rem;
            transition: all 0.2s;
            width: 100%;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: #fff;
        }

        .input-with-icon {
            display: flex;
            align-items: center;
        }

        .input-prefix {
            background: var(--border);
            padding: 12px 14px;
            border-radius: 10px 0 0 10px;
            border: 1px solid var(--border);
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .input-with-icon .form-input {
            border-radius: 0 10px 10px 0;
        }

        .route-group {
            background: #f1f5f9;
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-footer {
            padding: 1.5rem 2rem;
            background: #f8fafc;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
        }

        .btn-reset {
            background: transparent;
            color: var(--text-muted);
            border: none;
            font-weight: 500;
            cursor: pointer;
        }

        .alert-danger {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 2rem;
            display: flex;
            gap: 12px;
        }

        .alert-icon {
            background: #e11d48;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .alert-list {
            margin: 0;
            padding: 0 0 0 20px;
            color: #9f1239;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-header {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
@endsection
