@extends('layout.dashboard')

@section('content')
    <h1>Manage User</h1>

    <div style="margin-bottom:16px;">
        <a href="{{ route('user.create') }}">
            <button>+ Tambah User</button>
        </a>
    </div>

    @if (session('success'))
        <div class="card" style="background:#ecfdf5; color:#065f46;">
            {{ session('success') }}
        </div>
    @endif

    <!-- FILTER -->
    <div class="card" style="margin-bottom:16px;">
        <form method="GET" style="display:flex; gap:10px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name / Email">

            <select name="role">
                <option value="">All Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <span class="badge">
                                {{ $user->role }}
                            </span>
                        </td>

                        <td style="display:flex; gap:8px;">
                            <a href="{{ route('user.edit', $user->id) }}">
                                <button>Edit</button>
                            </a>

                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')

                                <button style="background:#ef4444;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada user</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div style="margin-top:20px; text-align:center;">
        @if ($users->onFirstPage())
            <span>«</span>
        @else
            <a href="{{ $users->previousPageUrl() }}">«</a>
        @endif

        Page {{ $users->currentPage() }} / {{ $users->lastPage() }}

        @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}">»</a>
        @else
            <span>»</span>
        @endif
    </div>
@endsection
