<?php

namespace App\Http\Resources\Api\Favorite;

use App\Http\Resources\Api\Package\PackageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'package_id'=>(int)$this->package_id,
            'package'=>new PackageResource($this->package),
        ];
    }
}
