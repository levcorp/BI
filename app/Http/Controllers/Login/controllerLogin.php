<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\RequestLogin;
class controllerLogin extends Controller
{
    public function __construct(){
        return $this->middleware('guest')->except('logout');
    }
    public function log(){
        return view('auth.login');
    }
    public function login(RequestLogin $request){
        $remember_me = $request->has('remember') ? true : false;
        if(Auth::attempt(['email' => $request->email."@levcorp.bo", 'password' => $request->password],$remember_me)){
            $user = auth()->user();
            Auth::login($user,true);
            return redirect()->route('panel');
        }else {
            return back()->withInput();         
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('log');
    }
}
