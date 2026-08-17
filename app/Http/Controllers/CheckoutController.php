<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        return view('cart', compact('cart', 'total'));
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
            'pickup_time' => 'required|in:now,15 minutes,30 minutes,60 minutes',
            'special_request' => 'nullable|string|max:500',
        ]);

        // Calculate total
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Convert pickup option into actual date/time
        $pickupTime = match ($request->pickup_time) {
            'now' => Carbon::now(),
            '15 minutes' => Carbon::now()->addMinutes(15),
            '30 minutes' => Carbon::now()->addMinutes(30),
            '60 minutes' => Carbon::now()->addMinutes(60),
            default => Carbon::now(),
        };

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'pickup_time' => $pickupTime,
            'special_request' => $request->special_request,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Create Stripe payment record
        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $total,
            'payment_method' => 'stripe',
            'status' => 'pending',
        ]);

        // Clear cart
        session()->forget('cart');

        // Send customer to Stripe
        return redirect()
            ->route('payment.create', $order);
    }
}