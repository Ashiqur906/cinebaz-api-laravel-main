<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Cinebaz\Member\Models\Member;
use Session;
use App\Http\Requests\OtpRequest;

class SocialController extends Controller
{

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => $this->guard()->factory()->getTTL() * 60,
            'message'       => 'Login Successfully Done!',
            'is_login'      => true
        ]);
    }
    public function guard()
    {
        return Auth::guard();
    }
    public function google(Request $request)
    {   

        $token  = $request->token;
        try {
            $user   = Socialite::driver('google')->userFromToken($token);
            return $this->_registerOrLoginUser($user);
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
        $getLogin = app('App\Http\Controllers\Api\v1\MemberController')->login2($credentials);
        return $getLogin;
    }
    public function otp(OtpRequest $request)
    {
        
        $phone = $request->phone;
        $checkUser    = Member::where('phone', $phone)->first();

        if ($checkUser) {

            $token = Auth::guard()->login($checkUser);
            return $this->respondWithToken($token);
        } else {
            $attributes = [
                'name'      => Null,
                'email'     => Null,
                'phone'     => $phone,
                'password'  => Null,
                'gender'    => Null,
            ];
            try {
                $create     = Member::create($attributes);
                $checkUser  = Member::where('phone', $phone)->first();
                if ($checkUser) {
                    $token = Auth::guard()->login($checkUser);
                    return $this->respondWithToken($token);
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                return response()->json([
                    'is_loging' => false,
                    'access_token' => null,
                    'token_type' =>  null,
                    'expires_in' =>  null,
                    'massege' => 'Unauthorized'
                ], 401);
            }
        }
        return response()->json([
            'is_loging' => false,
            'access_token' => null,
            'token_type' =>  null,
            'expires_in' =>  null,
            'massege' => 'Unauthorized'
        ], 401);
    }
}
