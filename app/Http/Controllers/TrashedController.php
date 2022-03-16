<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Session;

class TrashedController extends Controller
{
    function index(){
      $banner_trasheds = Banner::onlyTrashed()->get();
      return view('trashed.index', compact('banner_trasheds'));
    }
    // restore part
    function bannerrestore($banner_id){
      Banner::withTrashed()->where('id', $banner_id)->restore();
      Session::flash('trashedstatus', 'Trashed Moved Successfully!');
      return redirect()->back();
    }
    // force delete
    function bannerforcedelete($banner_id){
      Banner::withTrashed()->where('id', $banner_id)->forceDelete();
      Session::flash('forcestatus', 'Deleted Successfully!');
      return redirect()->back();
    }
}
