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
            'size'      => $this->size,
            'pattern'   => $this->pattern,
            'createdAt' => $this->created_at
        ];
    }
}
