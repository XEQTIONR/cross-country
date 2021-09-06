<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContainerContentResource extends JsonResource
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
            'id'            => $this->id,
            'container_num' => $this->container_num,
            'qty'           => $this->qty,
            'unitPrice'     => $this->unit_price,
            'totalTax'      => $this->total_tax,
            'totalWeight'   => $this->total_weight,
            'createdAt'     => $this->created_at,
            'tyre'          => new TyreResource($this->tyre),
        ];
    }
}
