@extends('layouts.app')

@section('title', 'Sun Cafe - ' . $product->name)

@section('content')

<div class="product-detail-container">

    <div class="product-detail-card">

        <div class="product-image">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
        </div>

        <div class="product-info">

            <h1>{{ $product->name }}</h1>

            <p class="category">
                {{ $product->category->name }}
            </p>

            <p class="description">
                {{ $product->description }}
            </p>

            <div class="price">
                ${{ number_format($product->price, 2) }}
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">

                @csrf

                <div class="quantity-section">
                    <label for="quantity">Quantity</label>

                    <input type="number"
                           id="quantity"
                           name="quantity"
                           value="1"
                           min="1">
                </div>

                <button type="submit" class="add-cart-btn">
                    Add to Cart
                </button>

            </form>

            <a href="{{ route('menu.index') }}" class="back-link">
                ← Back to Menu
            </a>

        </div>

    </div>

</div>

@endsection