<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureCustomerVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('customer.phone');
        }

        if (is_null(Auth::user()->phone_verified_at)) {
            Auth::logout();

            return redirect()
                ->route('customer.phone')
                ->withErrors(['phone' => 'يجب تأكيد رقم الجوال أولاً']);
        }

        return $next($request);
    }
}
