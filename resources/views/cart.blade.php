@extends('layouts.app')

@section('title', 'Sun Cafe - Cart')

@section('content')

<div class="menu-container">

    <div class="menu-header">
        <h1>Your Cart</h1>
    </div>

    @if(count($cart) > 0)

        <table class="cart-table">

            <thead>
                <tr>
                    <th>Drink</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                @php $total = 0; @endphp

                @foreach($cart as $item)

                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <tr>

                        <td>{{ $item['name'] }}</td>

                        <td>${{ number_format($item['price'],2) }}</td>

                        <td>

                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="qty-form">

                                @csrf

                                <input type="number"
                                       name="quantity"
                                       value="{{ $item['quantity'] }}"
                                       min="1">

                                <button type="submit">Update</button>

                            </form>

                        </td>

                        <td>${{ number_format($subtotal,2) }}</td>

                        <td>

                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">

                                @csrf

                                <button type="submit" class="remove-btn">
                                    Remove
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <div class="cart-total">
            Total: ${{ number_format($total,2) }}
        </div>

        <a href="{{ route('menu.index') }}" class="back-link">
            ← Continue Shopping
        </a>

        <a href="#" class="checkout-btn">
            Proceed to Checkout
        </a>

    @else

        <p style="text-align:center; font-size:18px; color:#777;">
            Your cart is empty.
        </p>

        <a href="{{ route('menu.index') }}" class="back-link">
            ← Back to Menu
        </a>

    @endif

</div>

@endsection