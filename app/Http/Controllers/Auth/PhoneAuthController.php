<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PhoneAuthController extends Controller
{
    private function normalizePhone(string $phone): string
    {
        return preg_replace('/\D+/', '', $phone) ?? $phone;
    }

    private function emailFromPhone(string $phone): string
    {
        // عشان جدول users الافتراضي غالبًا email required
        return 'p' . $phone . '@sheel.local';
    }

    public function showPhoneForm()
    {
        return view('auth.phone');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:8', 'max:20'],
        ]);

        $phone = $this->normalizePhone($request->phone);

        $user = User::query()->firstOrCreate(
            ['phone' => $phone],
            [
                'name' => 'عميل Sheel',
                'email' => $this->emailFromPhone($phone),
                'password' => Hash::make(str()->random(40)),
            ]
        );

        Auth::login($user, true);

        $bypass = (bool) config('otp.bypass');
        $code = $bypass ? (string) config('otp.bypass_code') : (string) random_int(1000, 9999);

        OtpCode::query()->create([
            'user_id' => $user->id,
            'phone' => $phone,
            'code_hash' => Hash::make($code),
            'expires_at' => now()->addMinutes((int) config('otp.expire_minutes')),
            'attempts' => 0,
        ]);

        session([
            'otp_phone' => $phone,
            'otp_hint' => $bypass ? $code : null, // يظهر في UI للتجربة فقط
        ]);

        return redirect()->route('phone.otp');
    }

    public function showOtpForm()
    {
        if (!session('otp_phone')) return redirect()->route('phone.start');
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'min:4', 'max:8'],
        ]);

        $phone = session('otp_phone');
        if (!$phone) return redirect()->route('phone.start');

        $otp = OtpCode::query()
            ->where('phone', $phone)
            ->whereNull('used_at')
            ->orderByDesc('id')
            ->first();

        if (!$otp || $otp->expires_at->isPast()) {
            return back()->withErrors(['code' => 'انتهت صلاحية الرمز. اطلب رمز جديد.']);
        }

        $otp->increment('attempts');

        if (!Hash::check((string) $request->code, $otp->code_hash)) {
            return back()->withErrors(['code' => 'رمز غير صحيح.']);
        }

        $otp->update(['used_at' => now()]);

        $user = Auth::user();
        $user->forceFill([
            'phone' => $phone,
            'phone_verified_at' => now(),
        ])->save();

        return redirect()->intended(route('shipments.create'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

