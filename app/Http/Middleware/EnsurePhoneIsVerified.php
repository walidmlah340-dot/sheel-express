<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePhoneIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && is_null($user->phone_verified_at)) {
            return redirect()->route('phone.start');
        }

        return $next($request);
    }
}

