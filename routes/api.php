<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Route::get('bookables', 'Api\BookableController@index');
// Route::get('bookables/{id}', 'Api\BookableController@show');

Route::apiResource('bookables', 'Api\BookableController')->only(['index', 'show']);
Route::get('bookables/{bookable}/availability', 'Api\BookableAvailabilityController')
    ->name('bookables.availability.show');
Route::get('bookables/{bookable}/reviews', 'Api\BookableReviewController')
    ->name('bookables.reviews.index');
Route::get('bookables/{bookable}/price', 'Api\BookablePriceController')
    ->name('bookables.price.show');

Route::get('/booking-by-review/{reviewKey}', 'Api\BookingByReviewController')
    ->name('booking.by-review.show');

Route::apiResource('reviews', 'Api\ReviewController')->only(['show', 'store']);

Route::post('checkout', 'Api\CheckoutController')->name('checkout');

Route::name('my.')->prefix('my')->middleware('auth')->group(function () {
    Route::apiResource('bookings', 'Api\My\BookingController')->only(['index']);
    Route::apiResource('reviews', 'Api\My\ReviewController')->only(['index']);
});

Route::name('host.')->prefix('host')->middleware('auth')->group(function () {
    Route::apiResource('bookables', 'Api\Host\BookableController')->only(['index', 'show', 'update', 'store']);
    Route::apiResource('/bookings/{bookable}', 'Api\Host\BookableBookingController')->only(['index']);
    Route::apiResource('/reviews/{bookable}', 'Api\Host\BookableReviewController')->only(['index']);
});
