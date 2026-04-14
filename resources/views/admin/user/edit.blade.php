@extends('layout.dashboard')

@section('content')
    <div class="form-container">
        <div class="form-header">
            <div class="header-title">
                <h1>Edit Profile User</h1>
                <p>Perbarui informasi akun untuk <strong>{{ $user->name }}</strong> (ID: #{{ $user->id }})</p>
            </div>
            <a href="{{ route('user.index') }}" class="btn-back">
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
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-section">
                        <label class="label-group">
                            <span class="label-text">Nama Lengkap</span>
                            <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}"
                                required>
                        </label>

                        <label class="label-group">
                            <span class="label-text">Alamat Email</span>
                            <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}"
                                required>
                        </label>

                        <label class="label-group">
                            <span class="label-text">Nomor Telepon</span>
                            <input type="text" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}"
                                required>
                        </label>
                    </div>

                    <div class="form-section">
                        <label class="label-group">
                            <span class="label-text">Peran User (Role)</span>
                            <select name="role" class="form-input" required>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>
                                    Customer</option>
                            </select>
                        </label>

                        <label class="label-group">
                            <span class="label-text">Kata Sandi Baru</span>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                                class="form-input">
                            <small style="color: #e11d48; font-size: 0.75rem; margin-top: 4px;">
                                *Biarkan kosong jika tetap ingin menggunakan password lama.
                            </small>
                        </label>
                    </div>
                </div>

                <div class="form-footer">
                    <a href="{{ route('user.index') }}" class="btn-reset"
                        style="text-decoration: none; line-height: 40px;">Batal</a>
                    <button type="submit" class="btn-submit">Update Data User</button>
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
            --white: #ffffff;
        }

        .form-container {
            max-width: 1000px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }

        /* Header Styling */
        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .title-with-icon {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .icon-badge {
            background: var(--primary);
            color: white;
            padding: 0.6rem;
            border-radius: 12px;
            display: flex;
        }

        .header-title h1 {
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .header-title p {
            color: var(--text-muted);
            margin: 0.5rem 0 0 0;
            font-size: 0.95rem;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        /* Card Styling */
        .form-card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            padding: 2.5rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Input Styling */
        .label-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .label-text {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            color: var(--text-muted);
        }

        .form-input {
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: #f8fafc;
            font-size: 1rem;
            transition: all 0.2s ease;
            color: var(--text-main);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: var(--white);
        }

        .input-hint {
            color: var(--text-muted);
            font-size: 0.8rem;
            margin-top: 6px;
        }

        /* Footer Styling */
        .form-footer {
            padding: 1.5rem 2.5rem;
            background: #f8fafc;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 1.5rem;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            border: none;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        .btn-cancel {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .btn-cancel:hover {
            color: #ef4444;
        }

        /* Alert Styling */
        .alert-danger {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            border-radius: 16px;
            padding: 1.25rem;
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }

        .alert-icon {
            background: #e11d48;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: 800;
            flex-shrink: 0;
        }

        .alert-content strong {
            color: #9f1239;
            display: block;
            margin-bottom: 0.25rem;
        }

        .alert-list {
            margin: 0;
            padding: 0 0 0 1.25rem;
            color: #be123c;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 850px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .form-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .btn-back {
                padding-left: 0;
            }
        }
    </style>
@endsection
