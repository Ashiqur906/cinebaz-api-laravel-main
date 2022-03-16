<?php

use Cinebaz\Setting\Models\Setting;
use Cinebaz\Category\Models\Category;
use Cinebaz\Genre\Models\Genre;

if (!function_exists('purchaseDutation')) {
    function purchaseDutation()
    {
        return [
            '1' => '1 Month',
            '3' => '6 Months',
            '6' => '6 Months',
            '12' => '1 Year',
            '24' => '2 Years',
            '36' => '3 Years',

        ];
    }
}
if (!function_exists('cz_video_api')) {
    function cz_video_api($vid)
    {
        $key = 'XkQNPnMw2z1e3YfRrOsDNbEScbJqAJK6akwbNn70hOHd37pwvEf15LeUcidPVGX6';
        $vid = $vid;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dev.vdocipher.com/api/videos/" . $vid . "/otp",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                "ttl" => 300,
            ]),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Apisecret " . $key,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
if (!function_exists('Movies')) {
    function Movies(){
        return $category_nav = Category::where('category_nature',1)->where('page_show',1)->get();
    }
}
if (!function_exists('TVShow')) {
    function TVShow(){
        return $category_nav = Category::where('category_nature',2)->where('page_show',1)->get();
    }
}
if (!function_exists('Gener')) {
    function Gener(){
        return $gener_nav = Genre::where('is_active','Yes')->get();
    }
}