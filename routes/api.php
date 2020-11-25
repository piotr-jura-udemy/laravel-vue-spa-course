<?php

use App\Http\Controllers\Api\Account\Customer\TripController;
use App\Http\Controllers\Api\BookableAvailabilityController;
use App\Http\Controllers\Api\BookableController;
use App\Http\Controllers\Api\BookablePriceController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\BookingByReviewController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Support\Facades\Route;

Route::apiResource('bookables', BookableController::class)->only(['index', 'show']);

Route::prefix('bookables')->group(function() {
    Route::get('{bookable}/availability', BookableAvailabilityController::class)
        ->name('bookables.availability.show');
    Route::get('{bookable}/reviews', BookableReviewController::class)
        ->name('bookables.reviews.index');
    Route::get('{bookable}/price', BookablePriceController::class)
        ->name('bookables.price.show');
});

Route::get('/booking-by-review/{reviewKey}', BookingByReviewController::class)
    ->name('booking.by-review.show');
Route::apiResource('reviews', ReviewController::class)->only(['show', 'store']);
Route::post('checkout', CheckoutController::class)->name('checkout');

Route::prefix('account')->name('account.')->middleware('auth')->group(function () {
    Route::get('customer/trips', [TripController::class, 'index'])->name('customer.trips.index');
});
