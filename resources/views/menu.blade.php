@extends('layouts.app')

@section('title', 'Sun Cafe - Menu')

@section('content')

<div class="menu-container">

    <div class="menu-header">
    </div>
    <div class="category-filter">

        <a href="{{ route('menu.index') }}"
            class="{{ request('category') ? '' : 'active' }}">
            All
        </a>

        @foreach($categories as $category)

        <a href="{{ route('menu.index', ['category' => $category->id]) }}"
            class="{{ request('category') == $category->id ? 'active' : '' }}">
            {{ $category->name }}
        </a>

        @endforeach

    </div>
    <div class="menu-grid">

        @forelse($products as $product)

        <div class="menu-card">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">

            <h3>{{ $product->name }}</h3>

            <div class="price">
                ${{ number_format($product->price, 2) }}
            </div>

            <a href="{{ route('menu.show', $product->id) }}" class="order-btn">
                Order Now
            </a>
        </div>


        @empty

        <p style="grid-column: 1 / -1; text-align: center; font-size: 18px; color: #888;">
            No products found in the menu.
        </p>

        @endforelse

    </div>

</div>

@if(session('cart_added'))

<div id="cart-toast" class="cart-toast">

    <div class="cart-toast-message">
        <strong>
            {{ session('cart_added.name') }}
        </strong>

        added to your cart.
    </div>

    <a
        href="{{ route('cart.index') }}"
        class="cart-toast-button">
        View Cart
    </a>

    <button
        type="button"
        class="cart-toast-close"
        onclick="closeCartToast()">
        ×
    </button>

</div>

@endif


<script>
    function closeCartToast() {
        const toast = document.getElementById('cart-toast');

        if (toast) {
            toast.classList.add('hide');

            setTimeout(function() {
                toast.remove();
            }, 300);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {

        const toast = document.getElementById('cart-toast');

        if (toast) {

            setTimeout(function() {
                closeCartToast();
            }, 5000);

        }

    });
</script>

@endsection