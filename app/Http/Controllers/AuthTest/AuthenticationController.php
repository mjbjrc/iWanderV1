<?php

namespace App\Http\Controllers\AuthTest;
use App\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticationController extends Controller
{
  public function init(){
    $user = Auth::user();
    return response()->json(['user' => $user], 200);
  }

  public function login(Request $request){
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){
      return response()->json(Auth::user(),200);
    }
    else{
      return response()->json(['error'=> 'Failed to log in.'], 401);
    }
  }

  public function register(Request $request){
    //check if user exists
    $user = User::where('email', $request->email)->first();
    if(isset($user->id)){
      return response()->json(['error' => 'Username already exists.'], 401);
    }

    $user = new User();

    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();

    Auth::login($user);

    return response()->json($user, 200);
  }

  public function logout(){
    Auth::logout();
  }
}
