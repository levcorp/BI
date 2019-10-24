<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controllerPWA extends Controller
{
    public function handleView(){
      return view("pwa.index");
    }
}
