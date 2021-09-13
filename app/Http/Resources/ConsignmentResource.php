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
            'containers'    => ContainerResource::collection($this->whenLoaded('containers')),
            'createdAt'     => $this->created_at->toDateString(),
            'exchange_rate' => $this->exchange_rate,
            'landDate'      => $this->land_date->toDateString(),
            'lcNum'         => $this->lc_num,
            'localValue'    => $this->value * $this->exchange_rate,
            'tax'           => $this->tax,
            'value'         => $this->value,
        ];
    }
}
