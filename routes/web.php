<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/contactus', function () {
    return view('pages.contactus');
});

Route::get('/aboutus', function () {
    return view('pages.aboutus');
});

Route::get('/mangrove', function () {
    return view('pages.mangrove');
});

Route::get('/karangterumbu', function () {
    return view('pages.karangterumbu');
});

Route::get('/garbage', function () {
    return view('pages.garbage');
});

Route::get('/turbin', function () {
    return view('pages.turbin');
});


// Halaman Home / Dashboard Kalkulator Utama
Route::get('/housing', function () {
    return view('calculator.housing');
})->name('calc.housing');

// (disiapkan untuk masa depan)
Route::get('/calctrans', function () {
    return view('calculator.calctrans');
})->name('calc.transport');

Route::get('/food', function () {
    return view('calculator.food');
})->name('calc.food');

Route::get('/expenditure', function () {
    return view('calculator.expenditure');
})->name('calc.expenditure');