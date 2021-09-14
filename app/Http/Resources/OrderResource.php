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
            $this->mergeWhen($this->whenLoaded('contents'), function () {

                    $subTotal = is_numeric($this->subTotal)
                        ? floatval($this->subTotal)
                        : $this->contents->reduce(function($carry, $item) {
                        return $carry + (intval($item->qty) * floatval($item->unit_price));
                    }, 0);
                    return [
                        'contents'           => OrderContentResource::collection($this->contents),
                        'subTotal'   => $subTotal,
                        'grandTotal' => $subTotal + floatval($this->tax_amount) - floatval($this->discount_amount)
                            + ($subTotal * floatval($this->tax_percentage)) - ($subTotal * floatval($this->discount_percentage))
                    ];
                }
            ),
            $this->mergeWhen($this->whenLoaded('payments'), [
                'payments'           => PaymentResource::collection($this->payments),
                'paymentsTotal'  => is_numeric($this->paymentsTotal)
                    ? floatval($this->paymentsTotal)
                    : $this->payments->reduce(function($carry, $item) {
                    return $carry + floatval($item->payment_amount) - floatval($item->refund_amount);
                }, 0),
            ]),
            'returns'            => OrderReturnResource::collection($this->whenLoaded('returns')),
            'taxAmount'          => $this->tax_amount,
            'taxPercentage'      => $this->tax_percentage,
        ];
    }
}
