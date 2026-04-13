<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .card-header {
            background: #0f172a;
            color: white;
            padding: 20px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #334155;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .btn {
            padding: 10px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-link {
            background: none;
            color: #3b82f6;
            margin-left: 10px;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            color: red;
            font-size: 13px;
        }

        .is-invalid {
            border-color: red;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
