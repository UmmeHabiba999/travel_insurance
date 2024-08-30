<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CreatePolicyController;
use Illuminate\Http\Request;
use App\Models\CreateQuotes;
use App\Models\Booking;

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

Route::get('/checkout', function (Request $request) {

    $quoteName = $request->query('quote_name');
    $createQuotes = CreateQuotes::where('name', $quoteName)->first();
    $booking_id = $createQuotes->booking_id;
    $booking = Booking::where('id', $booking_id)->first();
    return view('pages.website.checkout', compact('booking', 'createQuotes'));

});

Route::post('/create-policy', [CreatePolicyController::class, 'createPolicy'])->name('create-policy');


// Route::get('/checkout', function () {

//     return view('pages.website.checkout');

// });

// Route::get('/quotes', [BookingController::class, 'getTravelQuote'])->name('get.quote');

// Route::get('/', function () {

//     return view('pages.website.checkout');

// });
