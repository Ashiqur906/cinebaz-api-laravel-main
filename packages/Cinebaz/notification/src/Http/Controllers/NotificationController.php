<?php

namespace Cinebaz\Notification\Http\Controllers;

use App\Http\Controllers\Controller;
use Cinebaz\Tag\Http\Requests\TagFV;
use App\Models\Member;
use Cinebaz\Notification\Models\UserNotification;
use Illuminate\Http\Request;
use Validator;
use App\Notifications\MemberNotification;


class NotificationController extends Controller
{

    public function __construct()
    {
        //$this->middleware('outlet');
    }

    public function index()
    {
        $getNotifications = UserNotification::get();
        return view('notification::index')->with([
            'getNotifications' => $getNotifications
        ]);
    }
    public function create()
    {

        //$mdata = Category::where('is_active', 'yes')->get();
        return view('notification::add')->with([
            'mdata' => null,
            'fdata' => null,

        ]);
    }

    public function store(Request $request)
    {
        $message    = $request->message;
        $msg_title  = $request->subject;
        $link       = $request->link;
        for($i=0; $i<count($request->member); $i++){
           $NotifyUser = Member::find($request->member[$i])->notify(new MemberNotification($message,$msg_title,$link));
        }
        return redirect()->route('admin.notification.index');
    }

    // public function destroy(Request $request, $id)
    // {
    //     //dd($id);
    //     $category = Tag::findOrFail($id)->delete();

    //     return redirect()->route('admin.tag.index')->with('success', 'This request has been deleted');
    // }
}
