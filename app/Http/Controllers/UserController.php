<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function index(){
      $users = User::all();
      $roles = Role::get();
          
      return view('user.index')->with(['users' => $users, 'roles' => $roles]);
    }

  public function register(Request $request){
    return $request;
  }
}
