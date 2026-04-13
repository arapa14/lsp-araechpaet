<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            background: #f1f5f9;
        }

        /* NAVBAR */
        nav {
            background: #0f172a;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav h2 {
            margin: 0;
            font-size: 20px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
        }

        nav ul li a {
            color: #cbd5f5;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        nav ul li a:hover {
            color: white;
        }

        /* MAIN */
        main {
            padding: 30px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        /* FORM */
        form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        label {
            font-size: 14px;
        }

        select,
        input[type="date"] {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
        }

        button {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            background: #3b82f6;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #2563eb;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #1e293b;
            color: white;
            padding: 12px;
            font-size: 14px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        tr:hover {
            background: #f8fafc;
        }

        /* BADGE */
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            padding: 20px;
            color: #64748b;
        }
    </style>
</head>

<body>

    <nav>
        <h2>✈ Flight App</h2>

        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>

            @auth
                @if (auth()->user()->role === 'admin')
                    <li><a href="{{ route('schedule.index') }}">Manage Schedules</a></li>
                @endif

                @if (auth()->user()->role === 'customer')
                    <li><a href="{{ route('customer.history.index') }}">History</a></li>
                @endif

                <li><a href="{{ route('logout') }}">Logout</a></li>
            @endauth
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

</body>

</html>
