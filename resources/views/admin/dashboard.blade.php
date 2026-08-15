@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="admin-page">

    {{-- Header --}}
    <div class="admin-page-header">

        <div>
            <h1>Admin Dashboard</h1>
            <p>Welcome back, {{ auth()->user()->name }}.</p>
        </div>

    </div>

    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        {{-- Users --}}
        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Users
                    </h6>

                    <h2 class="mb-3">
                        {{ $totalUsers }}
                    </h2>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="btn btn-primary btn-sm">
                        Manage Users
                    </a>

                </div>

            </div>

        </div>


        {{-- Active Users --}}
        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Active Users
                    </h6>

                    <h2 class="mb-3">
                        {{ $activeUsers }}
                    </h2>

                    <span class="badge bg-success">
                        Active
                    </span>

                </div>

            </div>

        </div>


        {{-- Disabled Users --}}
        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Disabled Users
                    </h6>

                    <h2 class="mb-3">
                        {{ $disabledUsers }}
                    </h2>

                    <span class="badge bg-secondary">
                        Disabled
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- Products / Categories / Orders --}}
    <div class="row g-4">

        {{-- Products --}}
        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Products
                    </h6>

                    <h2>
                        {{ $totalProducts }}
                    </h2>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-outline-primary btn-sm">
                        Manage Products
                    </a>

                </div>

            </div>

        </div>


        {{-- Categories --}}
        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Categories
                    </h6>

                    <h2>
                        {{ $totalCategories }}
                    </h2>

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="btn btn-outline-primary btn-sm">
                        Manage Categories
                    </a>

                </div>

            </div>

        </div>


        {{-- Orders --}}
        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Orders
                    </h6>

                    <h2>
                        {{ $totalOrders }}
                    </h2>

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="btn btn-outline-primary btn-sm">
                        Manage Orders
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection