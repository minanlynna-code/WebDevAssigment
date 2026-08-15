@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="admin-page">

    <div class="admin-page-header">

        <div>
            <h1>Edit User</h1>
            <p>Update {{ $user->name }}'s information.</p>
        </div>

        <a
            href="{{ route('admin.users.index') }}"
            class="back-btn">
            ← Back to Users
        </a>

    </div>


    <div class="admin-form-card">

        <form
            action="{{ route('admin.users.update', $user) }}"
            method="POST">

            @csrf
            @method('PUT')


            {{-- Name --}}
            <div class="form-group">

                <label for="name">
                    Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required>

                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror

            </div>


            {{-- Email --}}
            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required>

                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror

            </div>


            {{-- Phone --}}
            <div class="form-group">

                <label for="phone">
                    Phone
                </label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $user->phone) }}">

                @error('phone')
                    <span class="form-error">{{ $message }}</span>
                @enderror

            </div>


            {{-- Role --}}
            <div class="form-group">

                <label for="role">
                    Role
                </label>

                <select
                    id="role"
                    name="role"
                    required>

                    <option
                        value="customer"
                        {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>
                        Customer
                    </option>

                    <option
                        value="admin"
                        {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                </select>

                @error('role')
                    <span class="form-error">{{ $message }}</span>
                @enderror

            </div>


            {{-- Password --}}
            <div class="form-group">

                <label for="password">
                    New Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password">

                <small class="text-muted">
                    Leave empty to keep the current password.
                </small>

                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror

            </div>


            {{-- Confirm Password --}}
            <div class="form-group">

                <label for="password_confirmation">
                    Confirm New Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation">

            </div>


            {{-- Status --}}
            <div class="form-group">

                <label>
                    Account Status
                </label>

                @if($user->is_active)

                    <div>
                        <span class="badge bg-success">
                            Active
                        </span>
                    </div>

                @else

                    <div>
                        <span class="badge bg-secondary">
                            Disabled
                        </span>
                    </div>

                @endif

            </div>


            <div class="form-actions">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="cancel-btn">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="admin-btn">
                    Update User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection