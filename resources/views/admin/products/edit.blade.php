@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="admin-page">

    <div class="admin-page-header">

        <div>
            <h1>Edit Product</h1>
            <p>Update {{ $product->name }}.</p>
        </div>

        <a
            href="{{ route('admin.products.index') }}"
            class="back-btn">
            ← Back to Products
        </a>

    </div>


    <div class="admin-form-card">

        <form action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data">
            
            @csrf
            @method('PUT')


            <div class="form-group">

                <label for="name">
                    Product Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    required>

                @error('name')
                <span class="form-error">{{ $message }}</span>
                @enderror

            </div>


            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4">{{ old('description', $product->description) }}</textarea>

                @error('description')
                <span class="form-error">{{ $message }}</span>
                @enderror

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label for="price">
                        Price
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        min="0"
                        step="0.01"
                        required>

                    @error('price')
                    <span class="form-error">{{ $message }}</span>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="category_id">
                        Category
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        required>

                        @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>

                        @endforeach

                    </select>

                    @error('category_id')
                    <span class="form-error">{{ $message }}</span>
                    @enderror

                </div>

            </div>


            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>

                @if($product->image)
                <div class="mb-2">
                    <img
                        src="{{ asset('images/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;">
                </div>
                @endif

                <input
                    type="file"
                    name="image"
                    id="image"
                    class="form-control"
                    accept="image/*">

                <small class="text-muted">
                    Leave empty if you want to keep the current image.
                </small>

                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-actions">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="cancel-btn">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="admin-btn">
                    Update Product
                </button>

            </div>

        </form>

    </div>

</div>

@endsection