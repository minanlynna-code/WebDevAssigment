@extends('layouts.app')

@section('title', 'Add User')

@section('content')

<div class="admin-page">

    <div class="admin-page-header">

        <div>
            <h1>Add User</h1>
            <p>Create a new user account.</p>
        </div>

        <a
            href="{{ route('admin.users.index') }}"
            class="back-btn">
            ← Back to Users
        </a>

    </div>


    <div class="admin-form-card">

        <form
            action="{{ route('admin.users.store') }}"
            method="POST">

            @csrf


            {{-- Name --}}
            <div class="form-group">

                <label for="name">
                    Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
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
                    value="{{ old('email') }}"
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
                    value="{{ old('phone') }}">

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

                    <option value="customer"
                        {{ old('role') === 'customer' ? 'selected' : '' }}>
                        Customer
                    </option>

                    <option value="admin"
                        {{ old('role') === 'admin' ? 'selected' : '' }}>
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
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required>

                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror

            </div>


            {{-- Confirm Password --}}
            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required>

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
                    Save User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection