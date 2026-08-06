@extends('layouts.app')

@section('title', 'Cart & Checkout')

@section('content')
<form class="checkout-page"
    action="{{ route('checkout.index') }}"
    method="GET">
    <!-- Progress Bar -->
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

        <div class="line"></div>

        <div class="step">
            <div class="circle"></div>
            <span>Checkout</span>
        </div>
    </div>

    <!-- Pickup Time -->
    <div class="pickup-section">
        <h2>Pickup Time</h2>

        <div class="pickup-options">
            <label><input type="radio" name="pickup" value="now" checked> Now</label>
            <label><input type="radio" name="pickup" value="15"> 15 Min</label>
            <label><input type="radio" name="pickup" value="30"> 30 Min</label>
            <label><input type="radio" name="pickup" value="60"> 60 Min</label>
        </div>
    </div>

    <!-- Cart Summary -->
    <div class="summary-section">
        <h2>Summary</h2>

        @php $total = 0; @endphp

        @forelse($cart as $item)

        @php
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
        @endphp

        <div class="summary-item">

            <div class="summary-image">
                <img src="{{ asset('images/' . $item['image']) }}"
                    alt="{{ $item['name'] }}">
            </div>

            <div class="summary-info">
                <h3>{{ $item['name'] }}</h3>
                <div class="qty-control">

                    <form action="{{ route('cart.decrease',$item['id']) }}" method="POST">
                        @csrf
                        <button>-</button>
                    </form>

                    <span>{{ $item['quantity'] }}</span>

                    <form action="{{ route('cart.increase',$item['id']) }}" method="POST">
                        @csrf
                        <button>+</button>
                    </form>

                </div>
            </div>

            <div class="summary-price">
                ${{ number_format($subtotal,2) }}
            </div>
            <form action="{{ route('cart.remove',$item['id']) }}" method="POST">

                @csrf

                <button class="remove-btn">
                    Remove
                </button>

            </form>

        </div>

        @empty

        <p>Your cart is empty.</p>

        @endforelse

    </div>

    <!-- Totals -->
    <div class="totals-section">

        <div class="total-row">
            <span>Subtotal</span>
            <span>${{ number_format($total,2) }}</span>
        </div>

        <div class="total-row">
            <span>Discount</span>
            <span>$0.00</span>
        </div>

        <div class="total-row grand-total">
            <span>Total</span>
            <span>${{ number_format($total,2) }}</span>
        </div>

    </div>

    <!-- Remark -->
    <div class="remark-section">
        <h2>Remark</h2>

        <textarea
            name="remark"
            placeholder="Less sugar, no ice, extra shot..."></textarea>
    </div>

    <!-- Checkout Button -->
    <div class="checkout-bottom">
        <form action="{{ route('checkout.store') }}" method="POST">

            @csrf

            <button class="checkout-button">
                CHECK OUT
            </button>

        </form>
    </div>

</form>
@endsection