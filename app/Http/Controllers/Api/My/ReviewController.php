<?php

namespace App\Http\Controllers\Api\My;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyReviewResource;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        return MyReviewResource::collection(
            $request->user()->reviews()
                ->with('bookable')->latest()->get()
        );
    }
}
