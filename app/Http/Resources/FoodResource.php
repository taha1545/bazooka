<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'type'=>$this->type,
            'description'=>$this->description,
             'price'=>$this->price,
             'evrgtime'=>$this->evrg_time,
             'FoodFiles'=> new FoodFileCollection ($this->foodFiles),
        ];
    }
}
