<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderContentResource extends JsonResource
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
            'id'        => $this->id,
            'order'     => new OrderResource($this->whenLoaded('order')),
            'item'      => new ContainerContentResource($this->whenLoaded('containerContent')),
            'qty'       => $this->qty,
            'unitPrice' => $this->unit_price,
            'createdAt' => $this->created_at,
        ];
    }
}
