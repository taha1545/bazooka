<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [ 
            'id'=>$this->id,
           'iscook'=>$this->is_cook == 1 ? true : false, 
           'isfinish'=>$this->is_finish == 1 ? true : false, 
           'Latitude'=>$this->location_lat, 
           'Longitude'=>$this->location_long, 
           'foods'=>new FoodCollection($this->foods), 
           'customer'=>new CustomerResource($this->customer), 
           'driver'=>new DriverResource($this->driver),
        ];
    }
}
