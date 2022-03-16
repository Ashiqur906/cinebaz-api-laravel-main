<?php

use Cinebaz\Series\Models\Series;

if (!function_exists('is_season')) {
    function is_season()
    {
        return true;
    }
}
if (!function_exists('getSeriesArr')) {
    function getSeriesArr()
    {
        $data = Series::where(['is_active' => 'Yes'])->get();
        // dd($data);
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title_en;
        }
        return $result;
    }
}
