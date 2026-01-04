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
<<<<<<< HEAD

Route::get('/turbin', function () {
    return view('pages.turbin');
});
=======
Route::get('/calctrans', function () {
    return view('pages.calctrans');
});
>>>>>>> e87fc206a554651f4cb3ecab198808197200e9c5
