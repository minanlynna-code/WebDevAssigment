@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')

<div class="container mt-5">

```
<h2>Manage Orders</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered align-middle">

    <thead class="table-dark">
        <tr>
            <th>Order</th>
            <th>Customer</th>
            <th>Items</th>
            <th>Total</th>
            <th>Pickup</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($orders as $order)

            <tr>

                <td>#{{ $order->id }}</td>

                <td>{{ $order->user->name }}</td>

                <td>

                    @foreach($order->items as $item)

                        {{ $item->product->name }}
                        (x{{ $item->quantity }})<br>

                    @endforeach

                </td>

                <td>
                    ${{ number_format($order->total_price, 2) }}
                </td>

                <td>{{ $order->pickup_time }}</td>

                <td>
                    <span class="badge bg-secondary">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>

                <td>

                    <form
                        action="{{ route('admin.orders.status', $order) }}"
                        method="POST"
                    >

                        @csrf

                        <select
                            name="status"
                            class="form-select form-select-sm mb-2"
                        >

                            @foreach(['pending','preparing','ready','completed','cancelled'] as $status)

                                <option
                                    value="{{ $status }}"
                                    @selected($order->status === $status)
                                >
                                    {{ ucfirst($status) }}
                                </option>

                            @endforeach

                        </select>

                        <button
                            class="btn btn-primary btn-sm w-100"
                        >
                            Update
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

    </tbody>

</table>
```

</div>

@endsection
