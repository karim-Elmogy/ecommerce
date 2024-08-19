<?php

namespace App\Http\Resources\Api\City;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'name'=>$this->name,
            'county_id'=>$this->county_id,
            'county_name'=>@$this->county->name,
            'url'=>$this->url,
            'slug'=>$this->slug,
            'image'=>$this->image ? url('/dash-img/city/'.$this->image) : null,

        ];
    }
}
