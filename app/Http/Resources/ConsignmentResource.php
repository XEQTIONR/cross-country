<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsignmentResource extends JsonResource
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
            'bol'           => $this->bol,
            'lc_num'        => $this->lc_num,
            'value'         => $this->value,
            'exchange_rate' => $this->exchange_rate,
            'tax'           => $this->tax,
            'land_date'     => $this->land_date,
            'created_at'    => $this->created_at,
            'containers'    => ContainerResource::collection($this->whenLoaded('containers'))
        ];
    }
}
