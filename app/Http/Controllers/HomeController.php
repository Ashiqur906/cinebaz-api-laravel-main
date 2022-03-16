<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cinebaz\Category\Models\Category;
use Cinebaz\Member\Models\Member;
use Cinebaz\Member\Models\Order;
use Cinebaz\Member\Models\OrderDetails;
use Cinebaz\Media\Models\Media;
use Cinebaz\Media\Models\PlayListLog;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $month          = date('m')-1;
        $members        = Member::count();
        $medias         = Media::count();
        $playLog        = PlayListLog::get()->unique('video_id');
        $categories     = Category::where('is_active','Yes')->where('deleted_at',null)->get();
        $topcategories  = Category::where('is_active','Yes')->where('page_show',1)->get();
        $orderList      = Order::whereMonth('created_at',$month)->orWhereMonth('created_at',date('m'))->OrderBy('id','DESC')->get();
        $freeMedia      = Media::where('premium', '0')->count();
        $premumMedia    = Media::where('premium', '1')->count();
        $releasedMedia  = Media::where('published_status', 1)->count();
        $upcommingMedia = Media::where('published_status', 0)->count();
        return view('home',compact('categories','members','medias','playLog','topcategories','orderList','freeMedia','premumMedia','releasedMedia','upcommingMedia'));
    }
    function adminregister(){
      return view('admin_register.index');
    }
    public function FCM(){

        return view('fcm_notification');
    }
    public function sendNotification(Request $request){
        $token = $request->token;  
        $from = "AAAAWFXrcRU:APA91bERM2T5Xb-tpBNFtb3CIh0tbYqZUKHUs0nsBzN2-xLmUQ64oMZRB5HG4zQsUJKQKlBRaCPaaCl6Zhi8XtOIHnPX-Fvwkkk6TrcOKTaM7HAV6ZqCInugWyu8LUvMnlkipNKVQKNL";
        $msg = array
              (
                'body'  => "Testing Testing",
                'title' => "Hi, From Raj",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );
        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
    }
}
