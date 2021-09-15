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
            'id'            => $this->id,
            'name'          => $this->name,
            'address'       => $this->address,
            'phone'         => $this->phone,
            'notes'         => $this->notes,
            'createdAt'     => $this->created_at,
            'orders'        => OrderResource::collection($this->whenLoaded('orders')),
            'orderedItems'  => OrderContentResource::collection($this->whenLoaded('orderedItems')),
            'payments'      => PaymentResource::collection($this->whenLoaded('payments')),
            'totalOrders'   => $this->when(isset($this->total_orders), floatval($this->total_orders)),
            'totalPayments' => $this->when(isset($this->total_payments), floatval($this->total_payments)),
            'balance'       => $this->when(isset($this->total_orders) && isset($this->total_payments),
                floatval($this->total_orders) - floatval($this->total_payments)),
        ];
    }
}
