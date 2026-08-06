@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <h2>Welcome Back</h2>
        <p>Please login to continue your order.</p>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    required
                    autofocus>

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-check mb-3">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember">

                <label class="form-check-label" for="remember">
                    Remember Me
                </label>

            </div>

            <button class="btn btn-warning w-100">
                Login
            </button>

        </form>

        <div class="auth-links">

            <a href="{{ route('password.request') }}">
                Forgot Password?
            </a>

            <p>
                Don't have an account?

                <a href="{{ route('register') }}">
                    Register
                </a>
            </p>

        </div>

    </div>

</div>

@endsection