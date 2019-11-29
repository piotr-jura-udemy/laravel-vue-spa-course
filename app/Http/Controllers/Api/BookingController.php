<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'bookable.id' => 'required|exists:bookables,id',
            'dates.from' => 'required|date|after_or_equal:now',
            'dates.to' => 'required|date|after_or_equal:dates.from',
            'customer.first_names' => 'required',
            'customer.surname' => 'required',
            'customer.address' => 'required',
            'customer.email' => 'required',
            'customer.country' => 'required',
            'customer.state' => 'required',
            'customer.zip' => 'required',
        ]);

        $bookable = Bookable::findOrFail($data['bookable']['id']);

        $isAvailable = $bookable->availableFor($data['dates']['from'], $data['dates']['to']);

        if (!$isAvailable) {
            return response()->json([
                'message' => 'The object is not available in given dates',
            ], 422);
        }

        $booking = new Booking();
        $booking->from = $data['dates']['from'];
        $booking->to = $data['dates']['to'];
        $booking->bookable_id = $data['bookable']['id'];
        $booking->price = $bookable->priceFor($data['dates']['from'], $data['dates']['to'])['total'];

        $booking->save();

        return $booking;
    }
}
