<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $title = 'title_' . (($request->get('lang')) ? $request->get('lang') : 'en');
        $description = 'description_' . (($request->get('lang')) ? $request->get('lang') : 'en');


        $published_status = 0;
        if ($this->published_at && $this->published_at < date('Y-m-d H:m:s')) {
            $published_status = 1;
        }


        return [
            'id'            => $this->id,
            'title'         => $this->$title,
            'slug'          => $this->slug,
            'description'   => $this->$description,
            'age_limit'     => $this->age_limit,
            'duration'      => $this->duration,
            'release_year'  => $this->release_year,
            'video_type'    => $this->video_type,
            'premium'       => $this->premium,
            'published_status' => $published_status,
            'starring'      => $this->starring,
            'regular_price' => $this->regular_price,
            'discount_price' => $this->discount_price,
            'trailer_url'   => $this->trailer_url,
            'video_url'     => $this->video_url,
            'youtube_url'   => $this->youtube_url,
            'thumbnail'     => new PictureResource($this->featured),
            'images'        => PictureResource::collection($this->images),
            'genres'        => GenreResource::collection($this->genres),
            'tags'          => TagResource::collection($this->tags),
            'categories'    => CategoryResource::collection($this->categories),

        ];
    }
}
