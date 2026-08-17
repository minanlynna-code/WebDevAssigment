<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with(['items.product', 'payment'])
            ->latest()
            ->get();

        return response()->json(['orders' => $orders]);
    }

    public function show(Request $request, Order $order): JsonResponse
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        $order->load(['items.product', 'payment']);

        return response()->json($order);
    }

    /**
     * Create an order from cart items sent by the Flutter app.
     * Expects: items: [{product_id, quantity}], pickup_time, remark
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'pickup_time' => ['required', 'in:now,15 minutes,30 minutes,60 minutes'],
            'remark' => ['nullable', 'string', 'max:500'],
        ]);

        $order = DB::transaction(function () use ($data, $request) {
            $total = 0;
            $lineItems = [];

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    abort(422, "Not enough stock for {$product->name}.");
                }

                $lineTotal = $product->price * $item['quantity'];
                $total += $lineTotal;

                $lineItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ];
            }

            $pickupTime = match ($data['pickup_time']) {
                'now' => Carbon::now(),
                '15 minutes' => Carbon::now()->addMinutes(15),
                '30 minutes' => Carbon::now()->addMinutes(30),
                '60 minutes' => Carbon::now()->addMinutes(60),
                default => Carbon::now(),
            };

            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => $total,
                'pickup_time' => $pickupTime->toDateTimeString(),
                'special_request' => $data['remark'] ?? null,
                'status' => 'pending',
            ]);

            foreach ($lineItems as $line) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $line['product']->id,
                    'quantity' => $line['quantity'],
                    'price' => $line['price'],
                ]);

                $line['product']->decrement('stock', $line['quantity']);
            }

            Payment::create([
                'order_id' => $order->id,
                'amount' => $total,
                'payment_method' => 'stripe',
                'status' => 'pending',
            ]);

            return $order;
        });

        $order->load(['items.product', 'payment']);

        return response()->json($order, 201);
    }
}
