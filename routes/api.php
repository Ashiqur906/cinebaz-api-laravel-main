<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'prefix' => 'v0/auth',
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api\v0',
], function () {

    Route::post('login', 'MemberController@login');
    Route::post('logout', 'MemberController@logout');
    Route::post('refresh', 'MemberController@refresh');
    Route::post('me', 'MemberController@me');
    Route::post('signup', 'MemberController@signup');

   
    Route::post('reset-password', 'MemberController@reset_password');

    Route::post('profile/update', 'MemberController@profileUpdate');
    // Google Login
    Route::post('login/google', 'SocialController@google');
    // Otp Login
    Route::post('login/otp', 'SocialController@otp');
});

Route::namespace('App\Http\Controllers\Api\v0')->middleware(['api'])->prefix('v0/')->group(function () {

    Route::get('homepage', 'FrontendController@homepage');
    Route::get('getCategory', 'FrontendController@get_category');
    Route::get('getSeries', 'FrontendController@get_series');
    Route::get('getmoviesByCategory', 'FrontendController@get_movies_by_cat');
    Route::get('getAllmovies', 'FrontendController@get_movies');
    Route::get('getMovieById', 'FrontendController@get_movie_id');
    Route::get('getMoviesByIds', 'FrontendController@get_movies_ids');
    Route::get('getMoviesByGenre', 'FrontendController@get_movies_by_genre');
    Route::post('addFavorite', 'FrontendController@add_favorite');
    Route::post('removeFavorite', 'FrontendController@remove_favorite');
    Route::get('getFavorite', 'FrontendController@get_favorite');
    Route::get('getListings', 'FrontendController@get_listings');
    Route::get('getAllFree', 'FrontendController@get_all_Free');
    Route::get('getAllSeries', 'FrontendController@get_all_Series');
    Route::get('subscriptions', 'FrontendController@subscriptions');
    Route::post('playList/save', 'FrontendController@savePlaylist');
    Route::post('playList/timer/save', 'FrontendController@saveTimer');

    // Save Orders
    Route::post('saveOrder', 'OrderController@saveOrder');

    // Member
    Route::get('member/profile', 'MemberController@member_profile');
    Route::get('member/billings', 'MemberController@member_billings');
    Route::get('member/invoice', 'MemberController@member_invoice');
    Route::get('member/playlog', 'MemberController@member_playlog');
    Route::get('member/notification/all', 'MemberController@all_notification');
    Route::get('member/notification/view', 'MemberController@single_notification');
    Route::get('member/notification/read', 'MemberController@read_notification');
    Route::get('member/notification/delete', 'MemberController@delete_notification');
});

Route::namespace('App\Http\Controllers\Api\v0')->middleware(['api'])->prefix('v0/')->group(function () {
    Route::get('home_web', 'FrontendController@home_web');
    Route::get('test', 'FrontendController@test');
});

// Version V1 Start
Route::group([
    'prefix' => 'v1/auth',
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api\v1',
], function () {

    Route::post('login', 'MemberController@login');
    Route::post('logout', 'MemberController@logout')->name('logout');
    Route::post('refresh', 'MemberController@refresh');
    Route::post('me', 'MemberController@me');
    Route::post('signup', 'MemberController@signup');
    Route::post('login/google', 'SocialController@google');
    Route::post('login/otp', 'SocialController@otp');
    Route::post('profile/update', 'MemberController@profileUpdate');
    Route::post('reset-password', 'MemberController@reset_password');
    Route::post('forgate-password', 'MemberController@forgate_password');

});
 
Route::namespace('App\Http\Controllers\Api\v1')->middleware(['api'])->prefix('v1/')->group(function () {
    Route::get('home', 'FrontendController@home_web'); 
    Route::get('getCategory', 'FrontendController@get_category');
    Route::get('getSeries', 'FrontendController@get_series');
    Route::get('getmoviesByCategory', 'FrontendController@get_movies_by_cat');
    Route::get('getmovies', 'FrontendController@get_movies');
    Route::get('getMovieById', 'FrontendController@get_movie_id');
    Route::get('getMoviesByIds', 'FrontendController@get_movies_ids');
    Route::get('getMoviesByGenre', 'FrontendController@get_movies_by_genre');
    Route::get('addFavorite', 'FrontendController@add_favorite');
    Route::get('add-wish-list', 'FrontendController@add_wish_list');
    Route::get('getFavorite', 'FrontendController@get_favorite');
    Route::get('getListings', 'FrontendController@get_listings');
    Route::get('getAllFree', 'FrontendController@get_all_Free');
    Route::get('subscriptions', 'FrontendController@subscriptions');
    Route::post('playList/save', 'FrontendController@savePlaylist');
    Route::post('playList/timer/save', 'FrontendController@savePlayListTimer');
    // Save Orders
    Route::post('saveOrder', 'OrderController@saveOrder');


    // Member
    Route::get('member/profile', 'MemberController@member_profile');
    Route::get('member/billings', 'MemberController@member_billings');
    Route::get('member/invoice', 'MemberController@member_invoice');
    Route::get('member/playlog', 'MemberController@member_playlog');
    Route::get('member/notification/all', 'MemberController@all_notification');
    Route::get('member/notification/view', 'MemberController@single_notification');
    Route::get('member/notification/read', 'MemberController@read_notification');
    Route::get('member/notification/delete', 'MemberController@delete_notification');
});

Route::namespace('App\Http\Controllers\Api\v1')->middleware(['api'])->prefix('v1/')->group(function () {

    Route::get('test', 'FrontendController@test');
});
// Version V1 End