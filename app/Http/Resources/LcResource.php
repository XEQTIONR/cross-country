<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LcResource extends JsonResource
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
            'lc_num'            => $this->lc_num,
            'applicant'         => $this->applicant,
            'beneficiary'       => $this->beneficiary,
            'consignments'      => ConsignmentResource::collection($this->whenLoaded('consignments')),
            'createdAt'         => $this->created_at->toDateString(),
            'currencyCode'      => $this->currency_code,
            'dateIssued'        => $this->date_issued->toDateString(),
            'dateExpiry'        => $this->date_expiry->toDateString(),
            'domesticAmount'    => $this->foreign_amount * $this->exchange_rate,
            'domesticExpense'   => $this->domestic_expense,
            'exchangeRate'      => $this->exchange_rate,
            'foreignAmount'     => $this->foreign_amount,
            'foreignExpense'    => $this->foreign_expense,
            'invoiceNumber'     => $this->invoice_num,
            'notes'             => $this->notes,
            'portArrive'        => $this->port_arrive,
            'portDepart'        => $this->port_depart,
            'totalExpense'      => $this->domestic_expense + ($this->foreign_expense * $this->exchange_rate),
        ];
    }
}
