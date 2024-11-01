<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'isbanned' => $this->is_banned == 1 ? true : false,
            'bonus' => $this->bonus,
            'user' => new UserResource($this->user),
        ];
    }
}
