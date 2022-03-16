<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Banner;
use Carbon\Carbon;
use Image;
use Session;

class SliderController extends Controller
{
  function index()
  {
    $banners = Banner::all();
    return view('banner.index', compact('banners'));
  }
  // Banner Heading, description, button, image insert
  function bannerinsert(Request $request)
  {
    $request->validate([
      'banner_title'        => 'required|string',
      'banner_description'  => 'required|string',
      'age_limit'           => 'required|integer',
      'duration'            => 'required|string',
      'play_button_text'    => 'required|string',
      'play_button_url'     => 'required|url',
      'details_button_text' => 'required|string',
      'details_button_url'  => 'required|url',
      'trailler_button_text'=> 'required|string',
      'trailler_button_url' => 'required|url',
    ]);
    $banner_id = Banner::insertGetId([
      'banner_title'        => $request->banner_title,
      'banner_description'  => $request->banner_description,
      'age_limit'           => $request->age_limit,
      'duration'            => $request->duration,
      'play_button_text'    => $request->play_button_text,
      'play_button_url'     => $request->play_button_url,
      'details_button_text' => $request->details_button_text,
      'details_button_url'  => $request->details_button_url,
      'trailler_button_text'=> $request->trailler_button_text,
      'trailler_button_url' => $request->trailler_button_url,
      'created_at' => Carbon::now(),
    ]);
    if ($request->hasFile('banner_image')) {
      $banner_photo       = $request->file('banner_image');
      $new_name           = $banner_id . "." . $banner_photo->getClientOriginalExtension();
      $save_location      = "public/uploads/banner_image/" . $new_name;
      Image::make($banner_photo)->save(base_path($save_location));
      Image::make($banner_photo)->resize(1600, 900)->save(base_path($save_location));
      Banner::findOrFail($banner_id)->update([
        'banner_image' => $new_name,
      ]);
    }
    Session::flash('status', 'Banner Inserted Successfully!');
    return redirect()->back();
  }
  // banner edit part
  function banneredit($banner_id)
  {
    $banner_edit = Banner::findOrFail($banner_id);
    return view('banner.edit', compact('banner_edit'));
  }
  // banner update part
  function bannerupdate(Request $request)
  {
    if ($request->hasFile('banner_image_new')) {
      if (Banner::findOrFail($request->banner_id)->banner_image != 'bannerimage.jpg') {
        unlink(base_path('public/uploads/banner_image/' . Banner::findOrFail($request->banner_id)->banner_image));
      }
      $banner_photo = $request->file('banner_image_new');
      $new_name = $request->banner_id . "." . $banner_photo->getClientOriginalExtension();
      $save_location = "public/uploads/banner_image/" . $new_name;
      // Image::make($banner_photo)->save(base_path($save_location));
      Image::make($banner_photo)->resize(1600, 900)->save(base_path($save_location));
      Banner::findOrFail($request->banner_id)->update([
        'banner_image' => $new_name,
      ]);
    }
    $request->validate([
      'banner_title' => 'string',
      'banner_description' => 'string',
      'age_limit' => 'integer',
      'duration' => 'string',
      'play_button_text' => 'string',
      'play_button_url' => 'url',
      'details_button_text' => 'string',
      'details_button_url' => 'url',
      'trailler_button_text' => 'string',
      'trailler_button_url' => 'url',
    ]);
    Banner::findOrFail($request->banner_id)->update([
      'banner_title' => $request->banner_title,
      'banner_description' => $request->banner_description,
      'age_limit' => $request->age_limit,
      'duration' => $request->duration,
      'play_button_text' => $request->play_button_text,
      'play_button_url' => $request->play_button_url,
      'details_button_text' => $request->details_button_text,
      'details_button_url' => $request->details_button_url,
      'trailler_button_text' => $request->trailler_button_text,
      'trailler_button_url' => $request->trailler_button_url,
    ]);
    Session::flash('updatestatus', 'Banner Edited Successfully!');
    return redirect('banner');
  }
  // banner status part
  // active part
  function banneractive($banner_id)
  {
    Banner::findOrFail($banner_id)->update([
      'read_status' => 2,
    ]);
    Session::flash('deactivestatus', 'Deactive Successfully!');
    return redirect('banner');
  }
  // deactive part
  function bannerdeactive($banner_id)
  {
    Banner::findOrFail($banner_id)->update([
      'read_status' => 1,
    ]);
    Session::flash('activestatus', 'Active Successfully!');
    return redirect('banner');
  }
  // banner trashed delete part
  function bannertrashed($banner_id)
  {
    Banner::findOrFail($banner_id)->delete();
    return back();
  }
}
