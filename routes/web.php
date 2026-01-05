<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialAuthController;


/*
|--------------------------------------------------------------------------
| Public Routes (Dapat diakses tanpa login)
|--------------------------------------------------------------------------
*/

// Homepage - Landing page utama
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Halaman Informasi
Route::get('/aboutus', function () {
    return view('pages.aboutus');
})->name('aboutus');

Route::get('/contactus', function () {
    return view('pages.contactus');
})->name('contactus');

// Halaman Solutions
Route::get('/solutions', function () {
    return view('pages.solutions');
})->name('solutions');

Route::get('/mangrove', function () {
    return view('pages.mangrove');
})->name('mangrove');

Route::get('/coralreefs', function () {
    return view('pages.karangterumbu');
})->name('karangterumbu');

Route::get('/garbage', function () {
    return view('pages.garbage');
})->name('garbage');

Route::get('/turbin', function () {
    return view('pages.turbin');
})->name('turbin');

Route::get('/projects', function () {
    return view('pages.ourproject');
})->name('ourproject');

// KALKULATOR - Bisa diakses tanpa login
Route::get('/calculator/housing', function () {
    return view('calculator.housing');
})->name('calc.housing');

Route::get('/calculator/transport', function () {
    return view('calculator.calctrans');
})->name('calc.transport');

Route::get('/calculator/food', function () {
    return view('calculator.food');
})->name('calc.food');

Route::get('/calculator/expenditure', function () {
    return view('calculator.expenditure');
})->name('calc.expenditure');


// Di web.php, tambahkan:
Route::get('/calculator', function () {
    return view('calculator.index');
})->name('calculator.index');
/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Halaman Login (redirect ke home jika sudah login)
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
})->name('login');

// Proses Login
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Proses Register
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/auth/google', [SocialAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback']);
/*
|--------------------------------------------------------------------------
| Protected Routes (Harus login terlebih dahulu)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Payment - Hanya bisa diakses setelah login
    Route::get('/payment', function () {
        return view('pages.payment');
    })->name('payment');
    
    Route::post('/payment/process', function () {
        // Logic untuk proses pembayaran
        return back()->with('success', 'Pembayaran berhasil diproses!');
    })->name('payment.process');
    
});