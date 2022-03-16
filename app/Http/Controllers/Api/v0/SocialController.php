<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Cinebaz\Member\Models\Member;
use Session;
class SocialController extends Controller
{
    public function google(Request $request){
        $token  = $request->token;
        try {
            $user   = Socialite::driver('google')->userFromToken($token);
            return $this->_registerOrLoginUser($user);
        } catch  (\Exception $e) {
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    =>  null,
                'expires_in'    =>  null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }
    public function _registerOrLoginUser($data)
    {
        $Member = Member::where('email', $data->email)->first();
        if (!$Member) {
            $Member = new Member();
            $Member->name           = $data->name;
            $Member->email          = $data->email;
            $Member->phone          = $data->id;
            $Member->password       = Hash::make('123456');
            $Member->gender         = 'Others';
            $Member->role           = 2;
            // $Member->provider_id    = $data->id;
            // $Member->avatar         = $data->avatar;
            $Member->save();

            $Member = Member::where('email', $data->email)->first();
        }

        $credentials = [
            'email' => $Member->email
        ];
        $dastination = Session::get('redirectUrl');
        $getLogin = app('App\Http\Controllers\Api\v0\MemberController')->login2($credentials);
        return $getLogin;
    }
    public function otp(Request $request){
        return $request;
    }
}
