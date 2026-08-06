@extends('layouts.app')

@section('title','Forgot Password')

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <h2>Forgot Password</h2>

        <p>
            Enter your email and we'll send you a password reset link.
        </p>

        @if(session('status'))

            <div class="alert alert-success">
                {{ session('status') }}
            </div>

        @endif

        <form method="POST" action="{{ route('password.email') }}">

            @csrf

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

            <button class="btn btn-warning w-100">
                Send Reset Link
            </button>

        </form>

    </div>

</div>

@endsection