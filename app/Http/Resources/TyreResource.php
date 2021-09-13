<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TyreResource extends JsonResource
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
            'id'        => $this->id,
            'brand'     => $this->brand,
            'createdAt' => $this->created_at->toDateString(),
            'pattern'   => $this->pattern,
            'lisi'      => $this->lisi,
            'size'      => $this->size,
        ];
    }
}
