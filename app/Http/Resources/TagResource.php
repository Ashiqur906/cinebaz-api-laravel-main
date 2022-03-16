<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * php artisan make:resource GenreResource
     * 
     */
    public function toArray($request)
    {
        $title = 'title_'.(($request->get('lang'))?$request->get('lang'):'en');
        return [
            'id' => $this->id,
            'title' => $this->$title,
        ];
    }
}
