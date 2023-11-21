<?php

namespace App\Http\Resources;

use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->uuid,
            'name'      => $this->name,
            'username'  => $this->username,
            'email'     => $this->email,
            'address'   => $this->address,
            'api_token' => $this->api_token,

            'orders'    => OrderResource::collection($this->whenLoaded('orders')),
            'cart'      => new CartResource($this->whenLoaded('cart')),
        ];
    }
}
