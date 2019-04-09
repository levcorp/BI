<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class controllerLogin extends Controller
{
    public function log()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->route('panel');
        }else {
            return redirect()->route('login');            
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
