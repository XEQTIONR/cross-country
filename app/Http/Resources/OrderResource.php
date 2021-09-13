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
            'order_num'          => $this->order_num,
            'createdAt'          => $this->created_at,
            'date'               => $this->order_date,
            'discountAmount'     => $this->discount_amount,
            'discountPercentage' => $this->discount_percentage,
            'customer'           => new CustomerResource($this->whenLoaded('customer')),
            'contents'           => OrderContentResource::collection($this->whenLoaded('contents')),
            'payments'           => PaymentResource::collection($this->whenLoaded('payments')),
            'paymentsTotal'      => floatval($this->paymentsTotal),
            'returns'            => OrderReturnResource::collection($this->whenLoaded('returns')),
            'subTotal'           => floatval($this->subTotal),
            'taxAmount'          => $this->tax_amount,
            'taxPercentage'      => $this->tax_percentage,
        ];
    }
}
