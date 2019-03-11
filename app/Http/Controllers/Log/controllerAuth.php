<?php

namespace App\Http\Controllers\Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class controllerAuth extends Controller
{
    public function inicio()
    {
        return view('auth.login');
    }
}
