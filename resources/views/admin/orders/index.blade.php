@extends('layouts.app')

@section('title','Manage Orders')

@section('content')

<div class="container py-4">

    <h1>Manage Orders</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>Order #</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Change</th>

            </tr>

        </thead>

        <tbody>

            @foreach($orders as $order)

            <tr>

                <td>{{ $order->order_number }}</td>

                <td>{{ $order->user->name }}</td>

                <td>${{ number_format($order->total,2) }}</td>

                <td>

                    <span class="badge bg-primary">

                        {{ ucfirst($order->status) }}

                    </span>

                </td>

                <td>

                    <form
                        action="{{ route('admin.orders.status',$order) }}"
                        method="POST">

                        @csrf

                        <select
                            name="status"
                            class="form-select">

                            <option value="pending">Pending</option>

                            <option value="preparing">Preparing</option>

                            <option value="ready">Ready</option>

                            <option value="completed">Completed</option>

                            <option value="cancelled">Cancelled</option>

                        </select>

                        <button
                            class="btn btn-warning mt-2">

                            Update

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection