<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = config('cz_media.lang.'.(($request->get('lang'))?$request->get('lang'):'en'));
        $title = 'title_'.$lang;
        return [
            'id' => $this->id,
            'title' => $this->$title,
            'medias' => MediaResource::collection($this->medias),
        ];
    }
}
