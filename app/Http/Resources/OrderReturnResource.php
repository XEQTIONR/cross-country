<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderReturnResource extends JsonResource
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
            'id' => $this->id,
            'item' => new ContainerContentResource($this->containerContent),
            'qty' => $this->qty,
            'unit_price' => $this->unit_price,
            'meta' => $this->meta,
        ];
    }
}
