<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $products = Product::with('category')
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name')
            ->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function show(Product $product): JsonResponse
    {
        $product->load('category');

        return response()->json($product);
    }

    public function categories(): JsonResponse
    {
        return response()->json([
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
