<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WasteResource extends JsonResource
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
            'item'      => new ContainerContentResource($this->whenLoaded('containerContent')),
            'qty'       => $this->qty,
            'createdAt' => $this->created_at,
        ];
    }
}
