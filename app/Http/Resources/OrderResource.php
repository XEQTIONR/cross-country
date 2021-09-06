<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_num'             => $this->order_num,
            'date'                  => $this->order_date,
            'customer'              => new CustomerResource($this->whenLoaded('customer')),
            'contents'              => OrderContentResource::collection($this->contents),
            'returns'               => OrderReturnResource::collection($this->returns),
            'payments'              => PaymentResource::collection($this->whenLoaded('payments')),
            'discountPercentage'    => $this->discount_percentage,
            'discountAmount'        => $this->discount_amount,
            'taxPercentage'         => $this->tax_percentage,
            'taxAmount'             => $this->tax_amount,
            'createdAt'             => $this->created_at,
        ];
    }
}
