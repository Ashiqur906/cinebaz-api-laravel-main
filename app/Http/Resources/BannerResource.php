<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
        // return parent::toArray($request);
        $title              = 'title_'.(($request->get('lang'))?$request->get('lang'):'en');
        $description        = 'description_'.(($request->get('lang'))?$request->get('lang'):'en');
        $short_description  = 'description_'.(($request->get('lang'))?$request->get('lang'):'en');
        return [
            'id'                    => $this->id,
            'media'                 => new MediaResource($this->Bannermedia),
            'title'                 => $this->$title,
            'description'           => $this->$description,
            'short_description'     => $this->$short_description,
            'image'                 => asset($this->image),
            'year'                  => $this->year,
            'age_limit'             => $this->age_limit,
            'duration'              => $this->duration,
            'play_button_url'       => $this->play_button_url,
            'details_button_url'    => $this->details_button_url,
            'trailler_button_url'   => $this->trailler_button_url,
        ];
    }
}
