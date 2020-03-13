<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyBookingIndex extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'booking_id' => $this->id,
            'from' => $this->from,
            'to' => $this->to,
            'price' => $this->price,
            'review_key' => $this->review_key,
            'bookable' => [
                'bookable_id' => $this->bookable->id,
                'title' => $this->bookable->title,
                'description' => $this->bookable->description
            ],
            'rating' => $this->review->rating ?? null
        ];
    }
}
