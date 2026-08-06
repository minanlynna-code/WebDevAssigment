<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->category, function ($query) use ($request) {
            $query->where('category_id', $request->category);
        })->get();

        return view('menu', compact('products', 'categories'));
    }
    public function show(Product $product)
    {
        $product->load('category');

        return view('product-detail', compact('product'));
    }
}
