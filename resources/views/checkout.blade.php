@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="checkout-container">

    <h1>Checkout</h1>

    <div class="checkout-card">

        <h3>Pickup Time</h3>
        <p>{{ $pickup }}</p>

        <h3>Remark</h3>
        <p>{{ $remark ?: 'No remark' }}</p>

    </div>

    <div class="checkout-card">

        <h2>Order Summary</h2>

        @php
            $total = 0;
        @endphp

        @foreach($cart as $item)

            @php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            @endphp

            <div class="checkout-item">

                <div>
                    <strong>{{ $item['name'] }}</strong><br>
                    Qty: {{ $item['quantity'] }}
                </div>

                <div>
                    ${{ number_format($subtotal,2) }}
                </div>

            </div>

        @endforeach

        <hr>

        <h3>Total: ${{ number_format($total,2) }}</h3>

    </div>

    <div style="margin-top:30px">

        <button class="checkout-button">
            PLACE ORDER
        </button>

    </div>

</div>

@endsection