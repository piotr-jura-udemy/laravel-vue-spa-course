<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountCustomerTripResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'to' => $this->to,
            'bookable_id' => $this->bookable->id,
            'bookable_title' => $this->bookable->title,
            'review_key' => $this->review_key,
            'rating' => optional($this->review)->rating,
            'price' => $this->price
        ];
    }
}
