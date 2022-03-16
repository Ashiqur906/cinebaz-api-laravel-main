<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillingResource extends JsonResource
{
    /** 
     * Transform the resource into an array.
     * php artisan make:resource BannerResource
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'order_id'  => $this->order_id,
            'media'     => new MediaResource($this->medias),
            'member'    => new ProfileResource($this->member),
            'deadline'  => $this->deadline
        ];
    }
}
