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
            'dateIssued'        => $this->date_issued,
            'dateExpiry'        => $this->date_expiry,
            'applicant'         => $this->applicant,
            'beneficiary'       => $this->beneficiary,
            'currencyCode'      => $this->currency_code,
            'foreignAmount'     => $this->foreign_amount,
            'foreignExpense'    => $this->foreign_expense,
            'domesticExpense'   => $this->domestic_expense,
            'exchangeRate'      => $this->exchange_rate,
            'portDepart'        => $this->port_depart,
            'portArrive'        => $this->port_arrive,
            'invoiceNumber'     => $this->invoice_num,
            'notes'             => $this->notes,
            'createdAt'         => $this->created_at,
            'consignments'      => ConsignmentResource::collection($this->whenLoaded('consignments')),
        ];
    }
}
