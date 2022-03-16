<?php

use Cinebaz\Category\Models\Category;
use Cinebaz\Genre\Models\Genre;
use Cinebaz\Tag\Models\Tag;
use Cinebaz\Media\Models\Media;

if (!function_exists('is_media')) {
    function is_media()
    {
        return true;
    }
}



if (!function_exists('fdate')) {
    function fdate($data, $formate = 'Y-m-d')
    {
        if (isset($data)) {
            return date($formate, strtotime($data));
        } else {
            return null;
        }
    }
}

if (!function_exists('fdata')) {
    function fdata($data)
    {
        if (isset($data)) {
            return $data;
        } else {
            return null;
        }
    }
}

if (!function_exists('getCategoryArr')) {
    function getCategoryArr()
    {
        $data = Category::where(['is_active' => 'Yes'])->get();
        // dd($data);
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title_english;
        }
        return $result;
    }
}
if (!function_exists('getMovieArr')) {
    function getMovieArr()
    {
        $data = Media::where(['is_active' => 'Yes'])->get();
        // dd($data);
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title_en;
        }
        return $result;
    }
}



if (!function_exists('getTagArr')) {
    function getTagArr()
    {
        $data = Tag::where(['is_active' => 'Yes'])->get();
        // dd($data);
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title_en;
        }
        return $result;
    }
}
if (!function_exists('getGenreArr')) {
    function getGenreArr()
    {
        $data = Genre::where(['is_active' => 'Yes'])->get();
        // dd($data);
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title_en;
        }
        return $result;
    }
}

if (!function_exists('boolStatusArr')) {
    function boolStatusArr()
    {
        return [
            0 => 'Inactive',
            1 => 'Active',
        ];
    }
}
if (!function_exists('boolPublishArr')) {
    function boolPublishArr()
    {
        return [
            0 => 'Published',
            1 => 'Unpublished',
        ];
    }
}
if (!function_exists('boolPremiumArr')) {
    function boolPremiumArr()
    {
        return [
            0 => 'Free',
            1 => 'Premium',
        ];
    }
}
if(!function_exists('PayCurrency')){
    function PayCurrency($val = null){
        if($val){
            return $mdata['currency'] = 'BDT'.' '. $val;
        }else{
            return $mdata['currency'] = 'BDT'.' ';
        }
    }
}