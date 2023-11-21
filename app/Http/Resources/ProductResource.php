<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductResource extends JsonResource
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
            'id'        => $this->uuid,
            'title'     => ucfirst($this->name),
            'desc'      => $this->description,
            'thumbnail' => $this->photo,
            'amount'    => $this->price,
            'available' => $this->stock_quantity
        ];
    }
}
