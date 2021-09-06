<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'id' => $this->id,
            'order_num' => $this->order_num,
            'order' => new OrderResource($this->whenLoaded('order')),
            'payment_amount' => $this->payment_amount,
            'refund_amount' => $this->refund_amount,
            'meta' => $this->meta,
            'createdAt' => $this->created_at,
        ];
    }
}
