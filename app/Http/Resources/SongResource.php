<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'song';
    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'album' => $this->resource->album,
            'genre' => $this->resource->genre,
            'musician' => $this->resource->musician
        ];
    }
}
