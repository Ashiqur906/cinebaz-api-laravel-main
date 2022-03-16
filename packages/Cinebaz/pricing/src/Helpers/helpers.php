<?php

use Cinebaz\Pricing\Models\Quality;
use Cinebaz\Pricing\Models\SubscriptionHead;
use Cinebaz\Pricing\Models\PlanHead;
if (!function_exists('is_pricing')) {
    function is_pricing()
    {
        return true;
    }
}



if (!function_exists('allSubHead')) {
    function allSubHead()
    {
        $data = SubscriptionHead::where('deleted_at',Null)->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title;
        }
        return $result;
    }
}
if (!function_exists('allPlanHead')) {
    function allPlanHead()
    {
        $data = PlanHead::where('deleted_at',Null)->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title;
        }
        return $result;
    }
}
if (!function_exists('allVideoQuality')) {
    function allVideoQuality()
    {
        $data = Quality::where('deleted_at',Null)->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title_en;
        }
        return $result;
    }
}
