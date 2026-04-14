@extends('layout.dashboard')

@section('content')
    <h1>Tambah User</h1>

    <form method="POST" action="{{ route('user.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="text" name="phone" placeholder="Phone"><br>

        <select name="role">
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
        </select><br>

        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Save</button>
    </form>
@endsection
