<?php

namespace App\Http\Resources\v1;

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
            'small'     => asset('storage/' . $this->small),

        ];
    }
}
