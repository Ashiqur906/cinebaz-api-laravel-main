<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Cinebaz\Member\Models\Order;

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
            'deadline'  => $this->deadline,
            'buying_date' => ($this->created_at)?date('d-M-Y h:i A', strtotime($this->created_at)): null
        ];
    }
}
