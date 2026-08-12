@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

<div class="container mt-5">

    <h2>My Orders</h2>

    @if($orders->isEmpty())

        <p>You haven't placed any orders yet.</p>

        <a href="{{ route('menu.index') }}">
            Browse Menu
        </a>

    @else

        <table class="table">

            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Pickup Time</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                @foreach($orders as $order)

                    <tr>

                        <td>
                            #{{ $order->id }}
                        </td>

                        <td>
                            {{ ucfirst($order->status) }}
                        </td>

                        <td>
                            ${{ number_format($order->total_price, 2) }}
                        </td>

                        <td>
                            {{ $order->pickup_time }}
                        </td>

                        <td>
                            <a href="{{ route('orders.show', $order) }}">
                                View
                            </a>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

</div>

@endsection