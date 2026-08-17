@extends('layouts.app')

@section('title', 'Cart & Checkout')

@section('content')
@if ($errors->any())
<div style="background:#ffdddd;padding:10px;margin-bottom:15px;border:1px solid red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="checkout-page">

    <!-- =========================
         PROGRESS
    ========================== -->
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
            <span>Checkout</span>
        </div>

    </div>

    <!-- =========================
             PICKUP TIME
        ========================== -->
    <div class="pickup-section">

        <h2>Pickup Time</h2>

        <p class="section-description">
            When would you like to pick up your order?
        </p>


        <div class="pickup-options">

            <label class="pickup-option">
                <input
                    type="radio"
                    name="pickup_time"
                    value="now"
                    checked>

                <span>Now</span>
            </label>


            <label class="pickup-option">
                <input
                    type="radio"
                    name="pickup_time"
                    value="15 minutes">

                <span>15 Min</span>
            </label>


            <label class="pickup-option">
                <input
                    type="radio"
                    name="pickup_time"
                    value="30 minutes">

                <span>30 Min</span>
            </label>


            <label class="pickup-option">
                <input
                    type="radio"
                    name="pickup_time"
                    value="60 minutes">

                <span>60 Min</span>
            </label>

        </div>

    </div>

    @if(count($cart) > 0)

    <!-- =========================
             CART ITEMS
        ========================== -->
    <div class="summary-section">

        <h2>Your Cart</h2>

        @php
        $total = 0;
        @endphp

        @foreach($cart as $item)

        @php
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
        @endphp

        <div class="summary-item">

            <!-- Product Image -->
            <div class="summary-image">
                <img
                    src="{{ asset('images/' . $item['image']) }}"
                    alt="{{ $item['name'] }}">
            </div>


            <!-- Product Info -->
            <div class="summary-info">

                <h3>{{ $item['name'] }}</h3>

                <p>
                    ${{ number_format($item['price'], 2) }} each
                </p>


                <!-- Quantity -->
                <div class="qty-control">

                    <form
                        action="{{ route('cart.decrease', $item['id']) }}"
                        method="POST">
                        @csrf

                        <button type="submit">−</button>
                    </form>


                    <span>
                        {{ $item['quantity'] }}
                    </span>


                    <form
                        action="{{ route('cart.increase', $item['id']) }}"
                        method="POST">
                        @csrf

                        <button type="submit">+</button>
                    </form>

                </div>

            </div>


            <!-- Subtotal -->
            <div class="summary-price">
                ${{ number_format($subtotal, 2) }}
            </div>


            <!-- Remove -->
            <form
                action="{{ route('cart.remove', $item['id']) }}"
                method="POST">
                @csrf

                <button
                    type="submit"
                    class="remove-btn">
                    Remove
                </button>

            </form>

        </div>

        @endforeach

    </div>

    <!-- =========================
             REMARK
        ========================== -->
    <div class="remark-section">

        <h2>Remark</h2>

        <textarea
            name="special_request"
            form="checkout-form"
            placeholder="Less sugar, no ice, extra shot..."></textarea>

    </div>


    <!-- =========================
             ORDER SUMMARY
        ========================== -->
    <div class="totals-section">

        <h2>Order Summary</h2>


        <div class="total-row">

            <span>Subtotal</span>

            <span>
                ${{ number_format($total, 2) }}
            </span>

        </div>


        <div class="total-row">

            <span>Discount</span>

            <span>
                $0.00
            </span>

        </div>


        <div class="total-row grand-total">

            <span>Total</span>

            <span>
                ${{ number_format($total, 2) }}
            </span>

        </div>

    </div>


    <!-- =========================
                PAYMENT
    ========================== -->
    <div class="payment-section">

        <h2>Payment</h2>

        <p class="section-description">
            You will be securely redirected to Stripe to complete your payment.
        </p>

    </div>


    <!-- =========================
     CHECKOUT
    ========================== -->
    <div class="checkout-bottom">

        <form
            id="checkout-form"
            action="{{ route('checkout.store') }}"
            method="POST">

            @csrf


            <!-- Pickup time -->
            <input
                type="hidden"
                name="pickup_time"
                id="selected-pickup-time"
                value="now">


            <!-- Special request -->
            <!-- <input
                type="hidden"
                name="special_request"
                id="special-request-hidden"> -->


            <button
                type="submit"
                class="checkout-button">
                CONTINUE TO PAYMENT
            </button>

        </form>

    </div>

    @else

    <!-- =========================
             EMPTY CART
        ========================== -->
    <div class="empty-cart">

        <h2>Your cart is empty</h2>

        <p>
            Add some drinks from our menu to get started.
        </p>

        <a
            href="{{ route('menu.index') }}"
            class="checkout-button">
            BACK TO MENU
        </a>

    </div>

    @endif

</div>


<!-- =========================
     PICKUP TIME SCRIPT
========================== -->

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const pickupOptions = document.querySelectorAll(
            'input[name="pickup_time"]'
        );

        const selectedPickupTime =
            document.getElementById('selected-pickup-time');


        pickupOptions.forEach(function(option) {

            option.addEventListener('change', function() {

                selectedPickupTime.value = this.value;

            });

        });

    });
</script>

@endsection