<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaylogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * php artisan make:resource FavoriteResource
     * 
     */
    public function toArray($request)
    {

        return new MediaResource($this->media);

        // return [
        //     'id'        => $this->id,
        //     'media_id'  => $this->media_id,
        //     'media'     => new MediaResource($this->media),
        // ];
    }
}
