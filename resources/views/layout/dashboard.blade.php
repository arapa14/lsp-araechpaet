<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>

    <!-- Navbar -->
    <nav>
        <h2>Flight App</h2>

        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>

            @auth
                @if (auth()->user()->role === 'admin')
                    <li><a href="#">Manage Flights</a></li>
                    <li><a href="#">Manage Users</a></li>
                @endif

                @if (auth()->user()->role === 'customer')
                    <li><a href="{{ route('customer.history.index') }}">Riwayat Pemesanan</a></li>
                @endif
                <li><a href="{{ route('logout') }}">Logout</a></li>
            @endauth
        </ul>
    </nav>

    <hr>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

</body>

</html>
