@extends('layout.dashboard')

@section('content')
    <h1>Customer Dashboard</h1>
    <a href="{{ route('logout') }}">
        Logout
    </a>
@endsection