<?php

namespace App\Http\Resources\Api\Offer;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'start'=>$this->start,
            'end'=>$this->end,
            'image'=>$this->image ? url('/dash-img/offer/'.$this->image) : null,

        ];
    }
}
