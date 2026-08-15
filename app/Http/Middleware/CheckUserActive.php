<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->is_active) {

            Auth::logout();

            return redirect()
                ->route('login')
                ->with('error', 'Your account has been disabled.');
        }

        return $next($request);
    }
}