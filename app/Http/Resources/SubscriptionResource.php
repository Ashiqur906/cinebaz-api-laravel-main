<?php

namespace App\Http\Resources;

use Cinebaz\Pricing\Models\PlanHead;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * php artisan make:resource SubscriptionResource
     * 
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'duration' => $this->duration,
            'details' => PlanHead::hasOption($this->id),
        ];
    }
}
