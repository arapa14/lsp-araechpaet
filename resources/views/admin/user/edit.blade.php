@extends('layout.dashboard')

@section('content')
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('user.update', $user->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $user->name }}"><br>
        <input type="email" name="email" value="{{ $user->email }}"><br>
        <input type="text" name="phone" value="{{ $user->phone }}"><br>

        <select name="role">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
        </select><br>

        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"><br>

        <button type="submit">Update</button>
    </form>
@endsection
