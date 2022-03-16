<?php

use Cinebaz\Setting\Models\Setting;

if (!function_exists('is_setting')) {
    function is_setting()
    {
        return true;
    }
}

if (!function_exists('cz_setting')) {
    function cz_setting($key)
    {
        $data = Setting::where(['key' => $key])->get()->first();
        if ($data) {

            if ($data->type == 'image') {

                return asset($data->value);
            } else {
                return $data->value;
            }
        }

        return '';
    }
}
if (!function_exists('cz_menu')) {
    function cz_menu($key)
    {
        $menuList = Menu::getByName($key);
        return $menuList;
    }
}
