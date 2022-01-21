<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'id' => $this->resource['id'],
            'name' => $this->resource['name'],
            'images' => $this->resource['images'],
            'main_image' => $this->resource['main_image'],
            'description' => $this->resource['description']
        ];
    }
}
