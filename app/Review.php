<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
