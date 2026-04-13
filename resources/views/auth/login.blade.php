@extends('layout.auth')

@section('title', 'Login')

@section('content')

    <div class="card">
        <div class="card-header">Welcome Back</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="form-group">
                    <label style="display:flex; align-items:center; gap:8px;">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember Me
                    </label>
                </div>

                <!-- Action -->
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <a class="btn-link" href="{{ route('register') }}">
                        Register
                    </a>
                </div>

            </form>
        </div>
    </div>

@endsection
