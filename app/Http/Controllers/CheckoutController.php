<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);

        $pickup = $request->pickup;

        $remark = $request->remark;

        return view('checkout', compact(
            'cart',
            'pickup',
            'remark'
        ));
    }
}