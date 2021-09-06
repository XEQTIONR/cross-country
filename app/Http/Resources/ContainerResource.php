<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContainerResource extends JsonResource
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
            'container_num' => $this->container_num,
            'bol'           => $this->bol,
            'createdAt'     => $this->created_at,
            'contents'      => ContainerContentResource::collection($this->whenLoaded('contents')),
        ];
    }
}
