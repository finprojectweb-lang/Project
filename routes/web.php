<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentCorporateController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CorporateCalculatorController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('pages.home'); })->name('home');
Route::get('/aboutus', function () { return view('pages.aboutus'); })->name('aboutus');
Route::get('/contactus', function () { return view('pages.contactus'); })->name('contactus');
Route::get('/solutions', function () { return view('pages.solutions'); })->name('solutions');
Route::get('/mangrove', function () { return view('pages.mangrove'); })->name('mangrove');
Route::get('/admin', function () { return view('pages.admin'); })->name('admin');
Route::get('/coralreefs', function () { return view('pages.karangterumbu'); })->name('karangterumbu');
Route::get('/garbage', function () { return view('pages.garbage'); })->name('garbage');
Route::get('/turbin', function () { return view('pages.turbin'); })->name('turbin');
Route::get('/projects', function () { return view('pages.ourproject'); })->name('ourproject');
Route::get('/news', function () { return view('pages.news'); })->name('news');

Route::get('/calculator/housing', function () { return view('calculator.housing'); })->name('calc.housing');
Route::get('/calculator/calctrans', function () { return view('calculator.calctrans'); })->name('calc.transport');
Route::get('/calculator/food', function () { return view('calculator.food'); })->name('calc.food');
Route::get('/calculator/expenditure', function () { return view('calculator.expenditure'); })->name('calc.expenditure');
Route::get('/calculator', function () { return view('calculator.index'); })->name('calculator.index');

Route::get('/discover-us/ourvalues', function () { return view('discoverus.ourvalues'); })->name('ourvalues');
Route::get('/discover-us/partners', function () { return view('discoverus.partcollab'); })->name('partners');

/*
|--------------------------------------------------------------------------
| Corporate Calculator Routes
|--------------------------------------------------------------------------
*/
Route::prefix('calculator/corporate')->name('calc.corporate.')->group(function () {
    Route::get('/',                [CorporateCalculatorController::class, 'index'])->name('index');
    Route::get('/wizard',          [CorporateCalculatorController::class, 'create'])->name('create');
    Route::post('/calculate',      [CorporateCalculatorController::class, 'calculate'])->name('calculate');
    Route::get('/result/{id}',     [CorporateCalculatorController::class, 'result'])->name('result');
    Route::get('/export-pdf/{id}', [CorporateCalculatorController::class, 'exportPdf'])->name('export-pdf');

    Route::get('/monitoring/{id}',          [CorporateCalculatorController::class, 'monitoring'])->name('monitoring');
    Route::get('/monitoring/{id}/progress', [CorporateCalculatorController::class, 'progressData'])->name('monitoring.progress');

    Route::get('/history', [CorporateCalculatorController::class, 'history'])->name('history')->middleware('auth');
    Route::delete('/{id}', [CorporateCalculatorController::class, 'delete'])->name('delete');
});

/*
|--------------------------------------------------------------------------
| Corporate Payment Routes  ← PERBAIKAN DI SINI
|--------------------------------------------------------------------------
*/

// Form result page submit ke sini — pakai PaymentCorporateController
Route::post('/payment/corporate/process', [PaymentCorporateController::class, 'process'])
    ->name('payment.process');

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

Route::get('/admin', function () {
    return view('pages.admin');
})->name('admin');

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

Route::get('/news', function () {
    return view('pages.news');
})->name('news');

// KALKULATOR - Bisa diakses tanpa login
Route::get('/calculator/housing', function () {
    return view('calculator.housing');
})->name('calc.housing');

Route::get('/calculator/calctrans', function () {
    return view('calculator.calctrans');
})->name('calc.transport');

Route::get('/calculator/food', function () {
    return view('calculator.food');
})->name('calc.food');

Route::get('/home-perusahaan', function () {
    return view('pages.homeperusahaan');
})->name('homeperusahaan');

Route::get('/calculator/expenditure', function () {
    return view('calculator.expenditure');
})->name('calc.expenditure');

Route::get('/calculator', function () {
    return view('calculator.index');
})->name('calculator.index');

Route::get('/discover-us/ourvalues', function () {
    return view('discoverus.ourvalues');
})->name('ourvalues');

Route::get('/discover-us/partners', function () {
    return view('discoverus.partcollab');
})->name('partners');

// Halaman review hasil pembayaran (views/payment/corporate.blade.php)
Route::get('/payment/corporate/{id}/review', function ($id) {
    $calculation = \App\Models\CorporateCalculation::findOrFail($id);
    return view('payment.corporate', compact('calculation'));
})->name('payment.corporate.review');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    if (auth()->check()) return redirect()->route('home');
    return view('auth.login');
})->name('login');

Route::post('/login',    [LoginController::class, 'login'])->name('login.post');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout',   [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/google',          [SocialAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| General Payment Routes (non-corporate, butuh auth)
|--------------------------------------------------------------------------
*/
Route::get('/payment/create/{calculation}', [PaymentController::class, 'create'])
    ->name('payment.create')
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.general.process');
    Route::get('/payment/success/{payment}', [PaymentController::class, 'success'])->name('payment.success');

    Route::get('/transactions',                  [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}',             [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/transactions/{id}/certificate', [TransactionController::class, 'certificate'])->name('transactions.certificate');
});

Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');