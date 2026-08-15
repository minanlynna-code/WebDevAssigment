<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $disabledUsers = User::where('is_active', false)->count();

        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'disabledUsers',
            'totalProducts',
            'totalCategories',
            'totalOrders'
        ));
    }
}