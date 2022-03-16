<?php

namespace Cinebaz\Seo\Traits;

use Cinebaz\Seo\Models\Seo;
use Illuminate\Http\Request;


trait TSeo
{
    public function seoPost($data)
    {

        $default = [
            'data' => null,
            'able_id' => null,
            'able_type' => null,
        ];

        $final = array_merge($default, $data);


        $request = $final['data'];
        if ($request) {
            $attributes = [
                'seoable_id' => $final['able_id'],
                'seoable_type' => $final['able_type'],
                'meta_title' => $request->get('meta_title'),
                'meta_description' => $request->get('meta_description'),
                'meta_keywords' => $request->get('meta_keywords'),
                'canonical_tag' => $request->get('canonical_tag'),
                'meta_type' => $request->get('meta_type'),
                'meta_image' => $request->get('meta_image'),
                'remarks' => $request->get('remarks'),
                'sort_by' => $request->get('sort_by'),
                'is_active' => $request->get('is_active') ? $request->get('is_active') : 'No',
                'modified_by' => auth('web')->user()->id,
            ];
            $id = $request->get('id');
            $seo_id = $request->get('seo_id');
            if (!$id) {
                $attributes['create_by']  = auth('web')->user()->id;
            }

            //dump($id);
            if ($seo_id) {
                $existing = Seo::findOrFail($seo_id);
                $data =  Seo::where('id', $existing->id)->update($attributes);
            } else {
                $data =  Seo::create($attributes);
            }
        }
    }
}
