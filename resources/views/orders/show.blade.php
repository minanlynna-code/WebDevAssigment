@extends('layouts.app')

@section('title', 'Order Details')

@section('content')

<div class="checkout-page">

<!-- Progress -->
<div class="checkout-progress">

    <div class="step active">
        <div class="circle"></div>
        <span>Menu</span>
    </div>

    <div class="line active"></div>

    <div class="step active">
        <div class="circle"></div>
        <span>Cart</span>
    </div>

    <div class="line active"></div>

    <div class="step active">
        <div class="circle"></div>
        <span>Completed</span>
    </div>

</div>

<div class="summary-section">

    <h2>Order Confirmation</h2>

    <p><strong>Order #:</strong> {{ $order->id }}</p>

    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

    <p><strong>Pickup Time:</strong> {{ $order->pickup_time }}</p>

    @if($order->special_request)

        <p>
            <strong>Remark:</strong>
            {{ $order->special_request }}
        </p>

    @endif

    <hr>

    <h3>Items</h3>

    @foreach($order->items as $item)

        <div class="summary-item">

            <div class="summary-info">

                <h3>{{ $item->product->name }}</h3>

                <p>
                    Qty: {{ $item->quantity }}
                </p>

            </div>

            <div class="summary-price">

                ${{ number_format(
                    $item->price * $item->quantity,
                    2
                ) }}

            </div>

        </div>

    @endforeach

    <hr>

    <div class="total-row grand-total">

        <span>Total</span>

        <span>
            ${{ number_format($order->total_price, 2) }}
        </span>

    </div>

    <div class="checkout-bottom">

        <a
            href="{{ route('orders.index') }}"
            class="checkout-button"
        >
            VIEW ALL ORDERS
        </a>

    </div>

</div>

</div>

@endsection
