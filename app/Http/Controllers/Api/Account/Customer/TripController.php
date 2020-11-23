<?php

namespace App\Http\Controllers\Api\Account\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountCustomerTripResource;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index(Request $request)
    {
        return AccountCustomerTripResource::collection(
            $request->user()
                ->bookings()
                ->with(['bookable', 'review'])
                ->latest()
                ->get()
        );
    }
}
