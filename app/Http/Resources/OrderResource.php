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
        $subTotal = is_numeric($this->subTotal)
            ? floatval($this->subTotal)
            : $this->contents->reduce(function($carry, $item) {
                return $carry + (intval($item->qty) * floatval($item->unit_price));
            }, 0);

        $grandTotal = is_numeric($this->grandTotal)
            ? floatval($this->grandTotal)
            : $subTotal + floatval($this->tax_amount) - floatval($this->discount_amount)
            + ($subTotal * floatval($this->tax_percentage))
            - ($subTotal * floatval($this->discount_percentage));

        $paymentsTotal = is_numeric($this->paymentsTotal)
            ? floatval($this->paymentsTotal)
            : $this->payments->reduce(function($carry, $item) {
            return $carry + floatval($item->payment_amount) - floatval($item->refund_amount);
        }, 0);

        return [
            'order_num'          => $this->order_num,
            'createdAt'          => $this->created_at,
            'date'               => $this->order_date->toDateString(),
            'discountAmount'     => $this->discount_amount,
            'discountPercentage' => $this->discount_percentage,
            'customerName'       => $this->when(isset($this->customerName), $this->customerName),

            $this->mergeWhen($this->whenLoaded('contents'), function () use ($subTotal, $grandTotal) {


                    return [
                        'contents'           => OrderContentResource::collection($this->contents),
                        'subTotal'   => $subTotal,
                        'grandTotal' => $grandTotal,
                    ];
                }
            ),
            $this->mergeWhen($this->whenLoaded('payments'), [
                'payments'           => PaymentResource::collection($this->payments),
                'paymentsTotal'  => $paymentsTotal,
            ]),

            'balance' => $this->when($this->whenLoaded('payments') && $this->whenLoaded('payments'),
                $grandTotal - $paymentsTotal),

            'returns'            => OrderReturnResource::collection($this->whenLoaded('returns')),
            'taxAmount'          => $this->tax_amount,
            'taxPercentage'      => $this->tax_percentage,
        ];
    }
}
