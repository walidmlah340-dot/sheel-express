<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ShipmentController;

Route::get('/', [LandingController::class, 'index'])->name('home');

/** زر دخول (للأدمن/المندوب لاحقًا) */
Route::get('/login', fn () => view('auth.login'))->name('login');

/** ===== عميل: رقم الجوال + OTP ===== */
Route::get('/customer/phone', [CustomerAuthController::class, 'showPhone'])->name('customer.phone');
Route::post('/customer/phone', [CustomerAuthController::class, 'sendOtp'])->name('customer.phone.send');

Route::get('/customer/otp', [CustomerAuthController::class, 'showOtp'])->name('customer.otp');
Route::post('/customer/otp', [CustomerAuthController::class, 'verifyOtp'])->name('customer.otp.verify');

Route::get('/customer/profile', [CustomerAuthController::class, 'showProfile'])->name('customer.profile');
Route::post('/customer/profile', [CustomerAuthController::class, 'saveProfile'])->name('customer.profile.save');

Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

/** ===== الشحن (لازم عميل متحقق) ===== */
Route::middleware(['customer.verified'])->group(function () {
    Route::get('/ship', [ShipmentController::class, 'create'])->name('ship.create');
    Route::post('/ship', [ShipmentController::class, 'store'])->name('ship.store');
    Route::get('/ship/pay/{order}', [ShipmentController::class, 'pay'])->name('ship.pay');
    Route::post('/ship/pay/{order}', [ShipmentController::class, 'payStore'])->name('ship.pay.store');
});
