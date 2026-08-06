@extends('layouts.app')

@section('title','Register')

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <h2>Create Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control"
                    required>

                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    required>

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

            <div class="mb-3">
                <label>Confirm Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required>
            </div>

            <button class="btn btn-warning w-100">
                Register
            </button>

        </form>

        <div class="auth-links">

            <p>

                Already have an account?

                <a href="{{ route('login') }}">
                    Login
                </a>

            </p>

        </div>

    </div>

</div>

@endsection