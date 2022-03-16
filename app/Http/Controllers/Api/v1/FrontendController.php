<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Session;
use App\Http\Resources\v1\BannerResource;
use App\Http\Resources\v1\CategoryMediaResource;
use App\Http\Resources\v1\CategoryResource;
use App\Http\Resources\v1\FavoriteResource;
use App\Http\Resources\v1\GenreResource;
use App\Http\Resources\v1\MediaResource;
use App\Http\Resources\v1\SeriesResource;
use App\Http\Resources\v1\SubscriptionResource;
use Cinebaz\Banner\Models\Banner;
use Cinebaz\Category\Models\Category;
use Cinebaz\Genre\Models\Genre;
use Cinebaz\Media\Models\Media;
use Cinebaz\Media\Models\PlayListLog;
use Cinebaz\Media\Models\MediaFavorite;
use Cinebaz\Media\Models\MediaListing;
use Cinebaz\Pricing\Models\PlanHead;
use Cinebaz\Pricing\Models\SubscriptionHead;
use Cinebaz\Series\Models\Series;
use Illuminate\Support\Facades\Cache;
use Cinebaz\Media\Models\MediaSimilar;

class FrontendController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('member:api', ['except' => ['test']]);
    }

    public function home_web(Request $request)
    {

        $genre      =   $request->genre;
        $lang       =   $request->lang;
        $member     =   auth()->user();




        $banner     =   cache()->remember('banner', 60 * 5, function () {
            return Banner::where(['name_id' => 1])->get();
        });



        $upcoming   =   cache()->remember('upcoming-media', 60 * 5, function () {
            return  Media::where('published_status', 0)
                ->inRandomOrder()
                ->take(10)
                ->get();
        });


        $free       =   cache()->remember('free-media', 60 * 5, function () {

            return Media::where('premium', '0')
                ->whereNotNull('published_at')
                ->where('published_at', '<', \DB::raw('NOW()'))
                ->where('is_active', 'Yes')
                ->inRandomOrder()
                ->take(10)
                ->with('featured')->get();
        });

        $premium    =   cache()->remember('premium-media', 60 * 5, function () {
            return  Media::where('premium', 1)
                ->where('published_status', 1)
                ->whereNotNull('video_url')
                ->inRandomOrder()
                ->take(10)
                ->get();
        });

        $category   =  cache()->remember('get-category', 60 * 5, function () {
            return  Category::all();
        });

        if ($member) {
            $favorites = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return   MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
        } else {
            $favorites = null;
        }
        if ($member) {
            $listings = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return   MediaListing::where('member_id', $member->id)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
        } else {
            $listings = null;
        }
        $section['home']['slider'][] = [
            'name' => 'Slider',
            'link' => '#',
            'medias' => BannerResource::collection($banner)
        ];
        $section['home']['category'][] = [
            'name' => 'Category',
            'link' => '#',
            'medias' => CategoryResource::collection($category)
        ];
        $section['home']['section'][] = [
            'name'      => 'Free',
            'link'      => '#',
            'medias'    => MediaResource::collection($free)
        ];
        $section['home']['section'][] = [
            'name' => 'Upcoming',
            'link' => '#',
            'medias' => MediaResource::collection($upcoming)
        ];
        $section['home']['section'][] = [
            'name' => 'Premium',
            'link' => '#',
            'medias' => MediaResource::collection($premium)
        ];

        if ($member) {
            $section['home']['section'][] = [
                'name' => 'Favourites',
                'link' => '#',
                'medias' => FavoriteResource::collection($favorites)
            ];
        }
        if ($member) {
            $section['home']['section'][] = [
                'name' => 'Wishlist',
                'link' => '#',
                'medias' => FavoriteResource::collection($listings)
            ];
        }
        return $section;
    }
    public function test()
    {
        $data = ['data' => 'Working'];
        return $data;

        // return $data;
    }
    public function get_category(Request $request)
    {
        $data = cache()->remember('get-category', 60 * 5, function () {
            return  Category::all();
        });

        return CategoryResource::collection($data);
        // return new CategoryResource($categories); for Singel
    }
    public function get_series(Request $request)
    {
        $limit = ($request->limit) ? $request->limit : 10;
        $lang = $request->lang;
        $data = Series::paginate($limit);


        return SeriesResource::collection($data, $lang);
    }
    public function get_movies(Request $request)
    {

        $limit  = ($request->limit) ? $request->limit : 10;
        $lang   = $request->lang;
        $data   =  Media::paginate($limit);



        return MediaResource::collection($data, $lang);
    }
    public function get_movie_id(Request $request)
    {


        $lang       = $request->lang;
        $media_id = $request->media_id;

        $details =  cache()->remember('get-movie-data-' . $media_id, 60 * 5, function () use ($media_id) {
            return   Media::find($media_id);
        });

        if ($details) {



            $data['details']    = new MediaResource($details);



            if ($details && $details->similars) {
                $data['others'][] = [
                    'name'      => 'Similer',
                    'link'      => '#',
                    'medias'    => MediaResource::collection($details->similars)
                ];
            }

            $recomended_muvies  = Media::orderby('id', 'DESC')->get();
            $data['others'][]  =  [
                'name' => 'Recomended',
                'link' => '#',
                'medias' => MediaResource::collection($recomended_muvies),
            ];
        } else {
            $data['details'] = null;
        }



        return $data; // for collection
    }
    public function get_movies_ids(Request $request)
    {
        try {
            $lang       = $request->lang;
            $media_id   = explode(',', $request->media_id);

            $data = Media::whereIn('id', $media_id)->get();
            return MediaResource::collection($data); // for collection
        } catch (\Exception $e) {
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    =>  null,
                'expires_in'    =>  null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }
    public function get_movies_by_cat(Request $request)
    {

        try {
            $id   = $request->id;

            $lang       = $request->lang;
            $data       = Category::find($id);

            return new CategoryMediaResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }
    public function get_movies_by_genre(Request $request)
    {
        $inp_genre  = $request->genre;
        $lang       = $request->lang;
        if (filter_var($inp_genre, FILTER_VALIDATE_INT) == true) {
            $genre = Genre::find($inp_genre);
        } else {
            $genre = Genre::where('slug', $inp_genre)->first();
        }

        if ($genre) {
            $data = new GenreResource($genre);
            $data = $data->additional(['medias' =>  MediaResource::collection($genre->medias)]);
            return $data;
        }
        return [];
    }
    public function add_favorite(Request $request)
    {
        $id = $request->mediaId;
        $media = Media::find($id);
        if ($media) {
            $ip = null;
            $user = auth()->user();
            $attFind = [
                'media_id' => $id,
                'member_id' => ($user) ? $user->id : null
            ];
            $existing = MediaFavorite::where($attFind)->first();

            if (!$existing) {
                try {

                    $insert = new MediaFavorite();
                    $insert->media_id = (int)$id;
                    $insert->member_id = ($user) ? $user->id : null;
                    $insert->browser_session = null;
                    $insert->member_ip = ($ip) ? $ip : null;
                    $insert->save();
                    return response()->json(['success' => true, 'message' => ' Successfully added']);
                    if (Cache::has('home-favorites-' . $user->id)) {
                        Cache::forget('home-favorites-' . $user->id);
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'is_loging'     => false,
                        'access_token'  => null,
                        'token_type'    =>  null,
                        'expires_in'    =>  null,
                        'massege'       => 'Unauthorized'
                    ], 401);
                }
            } else {
                $existing->delete();
                return response()->json(['success' => true, 'message' => ' Successfully removed']);
            }
        }
    }
    public function add_wish_list(Request $request)
    {
        $id = $request->mediaId;
        $media = Media::find($id);
        if ($media) {
            $ip = null;
            $user = auth()->user();
            $attFind = [
                'media_id' => $id,
                'member_id' => ($user) ? $user->id : null
            ];
            $existing = MediaListing::where($attFind)->first();

            if (!$existing) {
                try {

                    $insert = new MediaListing();
                    $insert->media_id = (int)$id;
                    $insert->member_id = ($user) ? $user->id : null;
                    $insert->browser_session = null;
                    $insert->member_ip = ($ip) ? $ip : null;
                    $insert->save();
                    return response()->json(['success' => true, 'message' => ' Successfully added']);
                    if (Cache::has('my-short-listing-' . $user->id)) {
                        Cache::forget('my-short-listing-' . $user->id);
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'is_loging'     => false,
                        'access_token'  => null,
                        'token_type'    =>  null,
                        'expires_in'    =>  null,
                        'massege'       => 'Unauthorized'
                    ], 401);
                }
            } else {
                $existing->delete();
                return response()->json(['success' => true, 'message' => ' Successfully removed']);
            }
        }
    }
    public function get_favorite(Request $request)
    {

        try {
            $lang       = $request->lang;
            $limit      = ($request->limit) ? $request->limit : 10;
            $member     = auth()->user();
            $favorite   = MediaFavorite::where('media_favorites.member_id', $member->id)
                ->paginate($limit);
            return FavoriteResource::collection($favorite);
        } catch (\Exception $e) {
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    =>  null,
                'expires_in'    =>  null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }

    public function get_listings(Request $request)
    {
        try {
            $lang       = $request->lang;
            $limit      = ($request->limit) ? $request->limit : 10;
            $member     = auth()->user();
            $favorite   = MediaListing::where('member_id', $member->id)
                ->paginate($limit);
            return FavoriteResource::collection($favorite);
        } catch (\Exception $e) {
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    =>  null,
                'expires_in'    =>  null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }
    public function get_all_Free(Request $request)
    {

        $lang       = $request->lang;
        $limit      = ($request->limit) ? $request->limit : 10;
        $free       =   cache()->remember('free-media-all', 60 * 5, function () use ($limit) {
            return  Media::where(['published_status' => 1, 'premium' => 0])
                ->whereNotNull('video_url')
                ->inRandomOrder()
                ->paginate($limit);
        });

        return MediaResource::collection($free);
    }

    public function subscriptions(Request $request)
    {
        try {
            $lang = $request->lang;
            $plan = SubscriptionHead::get();
            return SubscriptionResource::collection($plan);
        } catch (\Exception $e) {
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    =>  null,
                'expires_in'    =>  null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }
    public function savePlaylist(Request $request)
    {

        $member =  auth()->user();
        $existing = PlayListLog::where(['video_id' => $request->media_id, 'member_id' =>  $member->id])
            ->whereDate('created_at', date('Y-m-d'))
            ->first();


        try {

            $playlog = [
                'video_id'      => $request->media_id,
                'member_id'     =>  $member->id,
                'ip'     => $this->getIp(),
                'session_id'     => Session::getId(),
                'pre_time'  => ($existing) ? $existing->last_watchtime : null,
                'last_watchtime'    => ($existing) ? $existing->last_watchtime : null,
            ];
            if ($existing) {
                PlayListLog::where('id', $existing->id)->update($playlog);
                return response()->json([
                    'success' => true,
                    'message' => 'Timer Updated',
                ]);
            } else {
                // dd($playlog);
                PlayListLog::create($playlog);
                return response()->json([
                    'success' => true,
                    'message' => 'PlayLog added',
                ]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }
    public function savePlayListTimer(Request $request)
    {

        $member =  auth()->user();
        $existing = PlayListLog::where(['video_id' => $request->media_id, 'member_id' =>   $member->id])
            ->whereDate('created_at', date('Y-m-d'))
            ->first();

        try {

            $playlog = [
                'video_id'      => $request->media_id,
                'member_id'     => $member->id,
                'ip'     => $this->getIp(),
                'session_id'     => Session::getId(),
                'pre_time'  => ($existing) ? $existing->last_watchtime : null,
                'last_watchtime'    => ($existing) ? $existing->last_watchtime : null,
            ];
            if ($existing) {
                PlayListLog::where('id', $existing->id)->update($playlog);
                return response()->json([
                    'success' => true,
                    'message' => 'Timer Updated',
                ]);
            } else {
                // dd($playlog);
                PlayListLog::create($playlog);
                return response()->json([
                    'success' => true,
                    'message' => 'PlayLog added',
                ]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }
    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
