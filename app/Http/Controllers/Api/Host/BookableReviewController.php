<?php

namespace App\Http\Controllers\Api\Host;

use App\Bookable;
use App\Http\Controllers\Controller;

class BookableReviewController extends Controller
{
    public function index(Bookable $bookable)
    {
        return [
            'data' => $bookable->reviews()->with('author')
                ->latest()->get()
        ];
    }
}
