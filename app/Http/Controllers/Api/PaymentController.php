<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    /**
     * Create a Stripe Checkout Session and return the URL for the
     * Flutter app to open inside a WebView.
     */
    public function checkout(Request $request, Order $order): JsonResponse
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        $payment = Payment::where('order_id', $order->id)->firstOrFail();

        if ($payment->status === 'paid') {
            return response()->json(['message' => 'Already paid.'], 409);
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
            'success_url' => route('payment.mobile.success', $order) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.mobile.cancel', $order),
        ]);

        $payment->update(['stripe_session_id' => $session->id]);

        return response()->json(['checkout_url' => $session->url]);
    }

    /**
     * Public redirect target Stripe sends the WebView to after a successful
     * payment. Verifies with Stripe (not trusting the query string alone)
     * before marking the order paid, then shows a plain confirmation page
     * that the Flutter app watches for and closes the WebView on.
     */
    public function mobileSuccess(Request $request, Order $order)
    {
        $sessionId = $request->query('session_id');
        $payment = Payment::where('order_id', $order->id)->first();

        if ($sessionId && $payment && $payment->status !== 'paid') {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $payment->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                    'stripe_payment_intent' => $session->payment_intent,
                ]);

                $order->update(['status' => 'confirmed']);
            }
        }

        return response('
            <html><body style="font-family:sans-serif;text-align:center;padding-top:60px;">
                <h2>app-payment-success</h2>
                <p>Payment complete. You can return to the app.</p>
            </body></html>
        ');
    }

    public function mobileCancel(Order $order)
    {
        return response('
            <html><body style="font-family:sans-serif;text-align:center;padding-top:60px;">
                <h2>app-payment-cancel</h2>
                <p>Payment was cancelled. You can return to the app.</p>
            </body></html>
        ');
    }

    /**
     * The Flutter app calls this after closing the WebView to get the
     * authoritative order/payment status.
     */
    public function status(Request $request, Order $order): JsonResponse
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        $order->load('payment');

        return response()->json([
            'order_status' => $order->status,
            'payment_status' => $order->payment->status ?? 'pending',
        ]);
    }
}
