<?php

namespace Cinebaz\Admin\Traits;

use App\Models\User;
use App\Models\AdminPicture;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

trait TPicture
{
    public function imgPost($data)
    {
        // dd($data);
        $default = [
            'data' => null,
            'able_id' => null,
            'able_type' => null,
        ];

        $final = array_merge($default, $data);


        $request = $final['data'];
        if ($request->id) {
            $media = Member::find($request->id);
            $media->allimages()->delete();
        }

        if ($request->image) {
            $attributes = [
                'imageable_id'      => $final['able_id'],
                'imageable_type'    => $final['able_type'],

                'name'              => null,
                'file_name'         => null,
                'featured'          => true,
                'mime_type'         => null,
                'small'             => $request->image[0],
                'medium'            => $request->image[0],
                'full'              => $request->image[0],
                'thumbnail'         => $request->image[0],
                'remarks'           => $request->get('remarks'),
                'sort_by'           => $request->get('sort_by'),
                'is_active'         => 'Yes',
                'modified_by'       => auth('web')->user()->id,
            ];
            // dd($attributes);
            MemberPicture::create($attributes);
        }

        if ($request->post_file) {
            foreach ($request->post_file as $list) {
                $attributes = [
                    'imageable_id'      => $final['able_id'],
                    'imageable_type'    => $final['able_type'],
                    'name'              => null,
                    'file_name'         => null,
                    'featured'          => false,
                    'mime_type'         => null,
                    'small'             => $list,
                    'medium'            => $list,
                    'full'              => $list,
                    'thumbnail'         => $list,
                    'remarks'           => $request->get('remarks'),
                    'sort_by'           => $request->get('sort_by'),
                    'is_active'         => 'Yes',
                    'modified_by'       => auth('web')->user()->id,
                ];
                MemberPicture::create($attributes);
                //dump($attributes);
            }
        }
    }
    public function imgUpload($data)
    {
        // dd($data);
        $default = [
            'data' => null,
            'able_id' => null,
            'able_type' => null,
        ];

        $final = array_merge($default, $data);

        $request = $final['data'];
        $image = $request->file('image');
        // dd($request);
        if($image){
            $imageName = time() . uniqid(rand()) . '.'  . $image->extension();
            $data = 'images/dropzon/admin/' . $imageName;

            $image->move(public_path('images/dropzon/admin'), $imageName);

            if ($request->id) {
                $media = User::find($request->id);
                $media->allimages()->delete();
            }
        }
        if ($request->image) {
            $attributes = [
                'imageable_id'      => $final['able_id'],
                'imageable_type'    => $final['able_type'],

                'name'              => null,
                'file_name'         => null,
                'featured'          => true,
                'mime_type'         => null,
                'small'             => $data,
                'medium'            => $data,
                'full'              => $data,
                'thumbnail'         => $data,
                'remarks'           => $request->get('remarks'),
                'sort_by'           => $request->get('sort_by'),
                'is_active'         => 'Yes',
                // 'modified_by'       => auth('web')->user()->id,
            ];
            // dd($attributes);
            AdminPicture::create($attributes);
        }

        if ($request->post_file) {
            foreach ($request->post_file as $list) {
                $attributes = [
                    'imageable_id'      => $final['able_id'],
                    'imageable_type'    => $final['able_type'],

                    'name'              => null,
                    'file_name'         => null,
                    'featured'          => false,
                    'mime_type'         => null,
                    'small'             => $list,
                    'medium'            => $list,
                    'full'              => $list,
                    'thumbnail'         => $list,
                    'remarks'           => $request->get('remarks'),
                    'sort_by'           => $request->get('sort_by'),
                    'is_active'         => 'Yes',
                    // 'modified_by'       => auth('web')->user()->id,
                ];
                AdminPicture::create($attributes);
                //dump($attributes);
            }
        }
    }
}
