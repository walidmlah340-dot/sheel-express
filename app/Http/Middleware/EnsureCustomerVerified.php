<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Customer;

class EnsureCustomerVerified
{
    public function handle(Request $request, Closure $next)
    {
        $customerId = session('customer_id');
        if (!$customerId) {
            return redirect()->route('customer.phone');
        }

        $customer = Customer::find($customerId);
        if (!$customer || is_null($customer->phone_verified_at)) {
            session()->forget('customer_id');
            return redirect()->route('customer.phone');
        }

        // نخلي العميل متاح في كل الطلبات لو حبيت
        $request->attributes->set('customer', $customer);

        return $next($request);
    }
}

