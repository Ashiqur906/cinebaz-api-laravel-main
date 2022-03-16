<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        $arr            = json_decode($this->data);
        return [
            'id'            => $this->id,
            'data'          => $arr,
            'read_at'       => $this->read_at,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}