<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }
}
