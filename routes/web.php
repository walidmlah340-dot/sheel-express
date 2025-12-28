<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// صفحة الدخول
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// تنفيذ الدخول (مؤقت)
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    Auth::loginUsingId(1, true);

    return redirect('/dashboard');
});

// لوحة التحكم
Route::get('/dashboard', function () {
    if (!Auth::check()) return redirect('/login');
    return view('dashboard');
});

// تسجيل خروج
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
});
