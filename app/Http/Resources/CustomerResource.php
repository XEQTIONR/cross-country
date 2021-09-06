<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name'      => $this->name,
            'address'   => $this->address,
            'phone'     => $this->phone,
            'notes'     => $this->notes,
            'createdAt' => $this->created_at,
            'orders'    => OrderResource::collection($this->whenLoaded('orders')),
            'payments'    => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
