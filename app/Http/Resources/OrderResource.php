<?php

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'       => $this->uuid,
            'amount'   => $this->total_amount,
            'paid'     => $this->amount_paid,
            'paid_at'  => $this->paid_at,

            'customer' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
