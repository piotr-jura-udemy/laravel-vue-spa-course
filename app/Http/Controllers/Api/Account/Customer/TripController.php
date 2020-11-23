<?php

namespace App\Http\Controllers\Api\Account\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TripController extends Controller {
    public function index(Request $request)
    {
        return $request->user()->bookings()->with(['bookable', 'review'])->latest()->get();
    }
}