<?php
use App\Models\Member;

if (!function_exists('is_notification')) {
    function is_notification()
    {
        return true;
    }
}
if (!function_exists('getMemberArr')) {
    function getMemberArr()
    {
        $data = Member::get();
        // dd($data);
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->name;
        }
        return $result;
    }
}
