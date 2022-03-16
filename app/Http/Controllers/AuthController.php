<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:web', ['except' => ['login', 'index']]);
    }
    public function index()
    {
        if(auth('web')->user()){
            return redirect()->back();
        }else{
            return view('auth.login');
        }
        
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            //'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);


        // Attempt to log the user in
        if (Auth::guard('web')->attempt($credentials)) {

            // if successful, then redirect to their intended location
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return view('auth.login');
    }


}
