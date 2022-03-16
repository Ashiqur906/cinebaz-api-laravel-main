<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Cinebaz\Member\Models\OrderDetails;
use Cinebaz\Member\Models\Order;

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
        $playable = false;
        $starring = explode(',', $this->starring);
        $description = 'description_' . (($request->get('lang')) ? $request->get('lang') : 'en');
        $date = new \DateTime('now', new \DateTimezone('Asia/Dhaka'));
        $published_status = 0;
        if ($this->published_at && $this->published_at < date('Y-m-d H:m:s')) {
            $published_status = 1;
        }
        if ($published_status) {
            if ($this->premium) {
                if (auth()->user()->id) {
                    $purchased = OrderDetails::where([
                        'media_id' => $this->id,
                        'member_id' => auth()->user()->id,
                    ])->where('deadline', '>', $date->format('Y-m-d H:i:s'))
                        ->whereHas('orders', function ($query) {
                            $query->where('status', 'Complete');
                        })->latest()->first();


                    if ($purchased) {
                        $playable = true;
                    } else {
                        $playable = false;
                    }
                } else {
                    $playable = false;
                }
            } else {
                $playable = true;
            }
        } else {
            $playable = false;
        }






        return [

            'id'            => $this->id,
            'title'         => $this->$title,
            'slug'          => $this->slug,
            'description'   => strip_tags($this->$description),
            'age_limit'     => $this->age_limit,
            'duration'      => $this->duration,
            'release_year'  => $this->release_year,
            'video_type'    => $this->video_type,
            'premium'       => $this->premium,
            'published_at'       => $this->published_at,
            'published_status' => $published_status,
            'playable'       =>  $playable,
            'starring'      => $starring,
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
            'is_favorite'    => ($this->is_favorite()->count() > 0) ? true : false,
            'is_wishlist'    => ($this->is_wishlist()->count() > 0) ? true : false,


        ];
    }
}
