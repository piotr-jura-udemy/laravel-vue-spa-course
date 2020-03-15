<?php

namespace App\Http\Controllers\Api\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookableController extends Controller
{
    public function index(Request $request)
    {
        return [
            'data' => $request->user()
                ->bookables()
                ->latest()->get()
        ];
    }
}
