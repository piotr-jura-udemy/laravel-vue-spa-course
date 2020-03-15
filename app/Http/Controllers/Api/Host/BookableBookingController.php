<?php

namespace App\Http\Controllers\Api\Host;

use App\Bookable;
#use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookableBookingController extends Controller
{
    public function index(Bookable $bookable)
    {
        return ['data' => $bookable->bookings()->latest()->get()];
    }
}
