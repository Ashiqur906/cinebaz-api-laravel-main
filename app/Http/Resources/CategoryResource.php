<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'image' => isset($this->images[0]->small)? asset($this->images[0]->small) : null,
          
        ];
    }
}