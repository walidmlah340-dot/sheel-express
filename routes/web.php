<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\PhoneAuthController;
use App\Http\Controllers\ShipmentController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home.blade');
})->name('home');

/*
|--------------------------------------------------------------------------
| Phone OTP Auth
|--------------------------------------------------------------------------
*/
Route::get('/start', [PhoneAuthController::class, 'showPhoneForm'])->name('phone.start');
Route::post('/start', [PhoneAuthController::class, 'sendOtp'])->name('phone.send');

Route::get('/otp', [PhoneAuthController::class, 'showOtpForm'])->name('phone.otp');
Route::post('/otp', [PhoneAuthController::class, 'verifyOtp'])->name('phone.verify');

Route::post('/logout', [PhoneAuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::get('/me', function () {
    if (!Auth::check()) {
        return redirect()->route('phone.start');
    }

    return view('profile');
})->name('profile');

/*
|--------------------------------------------------------------------------
| Shipments (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'phone.verified'])->group(function () {
    Route::get('/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
    Route::post('/shipments', [ShipmentController::class, 'store'])->name('shipments.store');
    Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');
});
