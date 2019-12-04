<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'customer.first_names' => 'required|min:2',
            'customer.last_name' => 'required|min:2',
            'customer.street' => 'required|min:3',
            'customer.city' => 'required|min:2',
            'customer.email' => 'required|email',
            'customer.country' => 'required|min:2',
            'customer.state' => 'required|min:2',
            'customer.zip' => 'required|min:2'
        ]);
    }
}
