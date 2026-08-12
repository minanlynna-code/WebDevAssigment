@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')

<div class="container mt-5">

<h1>Admin Dashboard</h1>

<div class="row mt-4">

    <div class="col-md-3">

        <div class="card p-4 text-center">

            <h3>{{ $products }}</h3>

            <p>Products</p>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card p-4 text-center">

            <h3>{{ $orders }}</h3>

            <p>Orders</p>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card p-4 text-center">

            <h3>{{ $users }}</h3>

            <p>Customers</p>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card p-4 text-center">

            <h3>${{ number_format($sales,2) }}</h3>

            <p>Total Sales</p>

        </div>

    </div>

</div>

</div>

@endsection