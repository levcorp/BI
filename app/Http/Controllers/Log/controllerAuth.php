<?php

namespace App\Http\Controllers\Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;
use Route;
class controllerAuth extends Controller
{
    public function inicio()
    {
        return View::make('auth.login');
    }
    public function Login()
    {
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {   
            return Route::redirect('URI', 'URI', 301);
        }else {
            return redirect()->route('inicio');
        }
    }
}
