<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Get all products with their category
        $products = Product::with('category')->get();

        return view('menu', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('product-detail', compact('product'));
    }
}
