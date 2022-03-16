<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $title = 'title_'.(($request->get('lang'))?$request->get('lang'):'en');
        return [
            'id' => $this->id,
            'title' => $this->$title,
            'slug' => $this->slug,
            'medias' => MediaResource::collection($this->medias),
        ];
    }
}
