@extends('layout.auth')

@section('title', 'Register')

@section('content')

    <div class="card">
        <div class="card-header">Create Account</div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                        value="{{ old('name') }}" required>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                        name="phone" value="{{ old('phone') }}" required>

                    @if ($errors->has('phone'))
                        <span class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </span>
                    @endif
                </div>

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

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>

                    <a class="btn-link" href="{{ route('login') }}">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection