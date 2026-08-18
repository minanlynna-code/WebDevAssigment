@extends('layouts.app')

@section('title', 'Sun Cafe - ' . $product->name)

@section('content')

<div class="product-detail-container">

    <div class="product-detail-card">

        <div class="product-image-wrapper">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="product-detail-img">
        </div>

        <div class="product-info">

            <span class="category-badge">
                {{ $product->category->name }}
            </span>

            <h1 class="product-title">{{ $product->name }}</h1>

            <p class="product-description">
                {{ $product->description }}
            </p>

            <div class="product-price">
                ${{ number_format($product->price, 2) }}
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">

                @csrf

                <div class="quantity-group">
                    <label for="quantity">Quantity</label>

                    <input type="number"
                           id="quantity"
                           name="quantity"
                           value="1"
                           min="1"
                           class="quantity-input">
                </div>

                <button type="submit" class="product-submit-btn">
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