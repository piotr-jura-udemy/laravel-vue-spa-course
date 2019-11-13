<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show($id)
    {
        return Review::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|size:36',
            'content' => 'required|min:3',
            'rating' => 'required|in:1,2,3,4,5'
        ]);

        $booking = Booking::findByReviewKey($data['id']);

        if (null === $booking) {
            return abort(404);
        }

        $booking->review_key = null;
        $booking->save();

        $review = Review::make($data);
        $review->bookable_id = $booking->bookable_id;
        $review->bookind_id = $booking->id;
        $review->save();

        return $review;
    }
}
