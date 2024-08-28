<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CreatePolicyController;

Route::get('/booking', function () {

    return view('pages.website.bookingform');

});

Route::post('/add-booking', [BookingController::class, 'AddBooking'])->name('add.booking');

Route::post('/add-checkout', [BookingController::class, 'AddCheckout'])->name('add.checkout');

// Route::get('/checkout', [BookingController::class, 'CheckOut'])->name('checkout');
// Route::get('/booking', [BookingController::class, 'booking']);


Route::get('/get-quote', function () {

    return view('pages.website.get-quote');

});

Route::get('/checkout', function () {

    return view('pages.website.checkout');

});

Route::post('/create-policy', [CreatePolicyController::class, 'createPolicy'])->name('create-policy');


// Route::get('/checkout', function () {

//     return view('pages.website.checkout');

// });

// Route::get('/quotes', [BookingController::class, 'getTravelQuote'])->name('get.quote');

