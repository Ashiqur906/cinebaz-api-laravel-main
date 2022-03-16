<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'status'            => $this->sub_status,
            'address'           => $this->address,
            'transaction_id'    => $this->transaction_id,
            'currency'          => $this->currency,
            'created_at'        => $this->created_at,
            'order_details'     => OrderDetailsResource::collection($this->Details)
        ];
    }
}
