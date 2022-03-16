<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return $request->lang;
        // return parent::toArray($request);
        $title = 'title_'.(($request->get('lang'))?$request->get('lang'):'en');
        return [
            'id'        => $this->id,
            'title'     => $this->$title,
            'slug'      => $this->slug,
            'seasons'   => SeasonResource::collection($this->season),
        ];
    }
}
