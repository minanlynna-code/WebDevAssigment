@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')

<div class="admin-page">

    <div class="admin-page-header">
        <div>
            <h1>Manage Products</h1>
            <p>Add, edit and remove products from the cafe menu.</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="admin-btn">
            + Add Product
        </a>
    </div>


    @if(session('success'))
        <div class="admin-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="admin-card">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)

                    <tr>

                        <td>
                            @if($product->image)
                                <img
                                    src="{{ asset('images/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="admin-product-image"
                                >
                            @else
                                <span>No image</span>
                            @endif
                        </td>

                        <td>
                            <strong>{{ $product->name }}</strong>

                            @if($product->description)
                                <small>
                                    {{ Str::limit($product->description, 60) }}
                                </small>
                            @endif
                        </td>

                        <td>
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </td>

                        <td>
                            ${{ number_format($product->price, 2) }}
                        </td>

                        <td>

                            <div class="admin-actions">

                                <a
                                    href="{{ route('admin.products.edit', $product) }}"
                                    class="edit-btn"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('admin.products.destroy', $product) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-btn"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="empty-table">
                            No products found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection