<?php

namespace App\Http\Controllers\Api\Host;

use App\Bookable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookableController extends Controller
{
    public function index(Request $request)
    {
        return [
            'data' => $request->user()->bookables()->latest()->get()
        ];
    }

    public function show(Bookable $bookable)
    {
        return ['data' => $bookable];
    }

    public function update(Bookable $bookable, Request $request)
    {
        $bookable->fill($request->all());
        $bookable->save();

        return ['data' => $bookable];
    }

    public function store(Request $request)
    {
        $bookable = Bookable::make($request->all());
        $bookable->owner()->associate($request->user())->save();

        return ['data' => $bookable];
    }
}
