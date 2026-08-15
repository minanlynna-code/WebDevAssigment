<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'pickup_time' => 'required|string',
            'special_request' => 'nullable|string|max:500',
            'payment_method' => 'required|in:cash,card',
        ]);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . now()->format('YmdHis'),
            'total' => $total,
            'pickup_time' => $request->pickup_time,
            'remark' => $request->remark,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $total,
            'payment_method' => $request->payment_method,
            'status' => $request->payment_method === 'cash'
                ? 'pending'
                : 'pending',
        ]);

        session()->forget('cart');

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }
}
