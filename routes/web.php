<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/booking', function () {

    return view('pages.website.bookingform');

});

Route::post('/add-booking', [BookingController::class, 'AddBooking'])->name('add.booking');

Route::get('/get-quote', function () {

    return view('pages.website.get-quote');

});

Route::get('/checkout', function () {

    return view('pages.website.checkout');

});
