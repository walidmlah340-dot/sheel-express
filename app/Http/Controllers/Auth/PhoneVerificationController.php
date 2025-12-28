<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PhoneVerificationController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('auth.verify-phone', [
            'phone' => $user->phone,
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = Auth::user();

        if ($request->code != $user->phone_otp) {
            return back()->withErrors([
                'code' => 'رمز التحقق غير صحيح',
            ]);
        }

        $user->update([
            'phone_verified_at' => Carbon::now(),
            'phone_otp' => null,
        ]);

        return redirect()->route('dashboard');
    }

    public function resend()
    {
        $user = Auth::user();

        $otp = rand(100000, 999999);

        $user->update([
            'phone_otp' => $otp,
        ]);

        // مؤقتًا في اللوج
        Log::info("OTP for {$user->phone} is: {$otp}");

        return back()->with('status', 'تم إعادة إرسال رمز التحقق');
    }
}
