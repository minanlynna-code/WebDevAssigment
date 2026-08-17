<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        // Make sure this order belongs to the logged-in user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $payment = Payment::where('order_id', $order->id)->firstOrFail();

        if ($payment->status === 'paid') {
            return redirect()
                ->route('orders.show', $order)
                ->with('success', 'This order has already been paid.');
        }
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'mode' => 'payment',

            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',

                    'product_data' => [
                        'name' => 'Cafe Order #' . $order->id,
                    ],

                    'unit_amount' => (int) round($payment->amount * 100),
                ],

                'quantity' => 1,
            ]],

            'success_url' => route('payment.success', $order)
                . '?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => route('payment.cancel', $order),
        ]);

        $payment->update([
            'stripe_session_id' => $session->id,
        ]);

        return redirect($session->url);
    }

    public function success(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect()
                ->route('orders.show', $order)
                ->with('error', 'Payment session was not found.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($sessionId);

        $payment = Payment::where('order_id', $order->id)->firstOrFail();

        if ($session->payment_status === 'paid') {

            $payment->update([
                'status' => 'paid',
                'paid_at' => now(),
                'stripe_payment_intent' => $session->payment_intent,
            ]);

            $order->update([
                'status' => 'confirmed',
            ]);

            // Clear cart ONLY after successful Stripe payment
            session()->forget('cart');

            return redirect()
                ->route('orders.show', $order)
                ->with('success', 'Payment successful! Your order is confirmed.');
        }

        return redirect()
            ->route('orders.show', $order)
            ->with('error', 'Payment was not completed.');
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return redirect()
            ->route('orders.show', $order)
            ->with('error', 'Payment was cancelled.');
    }
}
