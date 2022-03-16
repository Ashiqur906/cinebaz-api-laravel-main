<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PictureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * php artisan make:resource PictureResource
     * 
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'thumbnail' => asset('storage/'.$this->thumbnail),
            'small'     => asset('storage/'.$this->small),
            'medium'    => asset('storage/'.$this->medium),
            'full'      => asset('storage/'.$this->full),
        ];
    }
}
