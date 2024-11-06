<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'online' => $this->is_online == 1 ? true : false,
            'charge' => $this->is_charge == 1 ? true : false,
           'user' => new UserResource($this->user),
        ];
    }
}
