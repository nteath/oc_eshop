<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->uuid,
            'original_value' => $this->value,
            'current_value'  => $this->calculateCurrentValue(),

            'items'          => CartItemResource::collection($this->whenLoaded('items')),
            'user'           => new UserResource($this->whenLoaded('user')),
        ];
    }
}
