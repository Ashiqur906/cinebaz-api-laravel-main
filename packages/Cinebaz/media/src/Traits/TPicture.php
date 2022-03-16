<?php

namespace Cinebaz\Media\Traits;

use Cinebaz\Media\Models\Media;
use Cinebaz\Media\Models\Picture;
use Illuminate\Http\Request;


trait TPicture
{
    public function imgPost($data)
    {

        $default = [
            'data' => null,
            'able_id' => null,
            'able_type' => null,
        ];

        $final = array_merge($default, $data);


        $request = $final['data'];
        if ($request->id) {
            $media = Media::find($request->id);
            $media->allimages()->delete();
        }

        if ($request->featured_img) {
            $attributes = [
                'imageable_id' => $final['able_id'],
                'imageable_type' => $final['able_type'],

                'name' => null,
                'file_name' => null,
                'featured' => true,
                'mime_type' => null,
                'small' => $request->featured_img[0],
                'medium' => $request->featured_img[0],
                'full' => $request->featured_img[0],
                'thumbnail' => $request->featured_img[0],
                'remarks' => $request->get('remarks'),
                'sort_by' => $request->get('sort_by'),
                'is_active' => 'Yes',
                'modified_by' => auth('web')->user()->id,
            ];
            // dd($attributes);
            Picture::create($attributes);
        }

        if ($request->post_file) {
            foreach ($request->post_file as $list) {
                $attributes = [
                    'imageable_id' => $final['able_id'],
                    'imageable_type' => $final['able_type'],

                    'name' => null,
                    'file_name' => null,
                    'featured' => false,
                    'mime_type' => null,
                    'small' => $list,
                    'medium' => $list,
                    'full' => $list,
                    'thumbnail' => $list,
                    'remarks' => $request->get('remarks'),
                    'sort_by' => $request->get('sort_by'),
                    'is_active' => 'Yes',
                    'modified_by' => auth('web')->user()->id,
                ];
                Picture::create($attributes);
                //dump($attributes);
            }
        }
    }
}
