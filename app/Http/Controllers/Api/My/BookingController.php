<?php

namespace App\Http\Controllers\Api\My;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyBookingIndex;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        return MyBookingIndex::collection(
            $request->user()->bookings()->with('bookable', 'review')->latest()->get()
        );
    }
}
