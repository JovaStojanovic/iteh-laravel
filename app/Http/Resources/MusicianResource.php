<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MusicianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'musician';
    public function toArray($request)
    {
        return [
            'name'=>$this->resource->name,
            'instrument'=>$this->resource->instrument,
            'Biography'=>$this->resource->biography,
        ];
    }
}
