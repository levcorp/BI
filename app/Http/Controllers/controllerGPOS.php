<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text\EDIGPOS;
use App\GPOS;
use Mail;
use App\Mail\Edi\Success;
use App\Mail\Edi\Failure;
class controllerGPOS extends Controller
{
    public function datos()
    {   
        return Mail::send(new Failure);
        return GPOS::all();
    }
    public function index()
    {
        $gpos=new EDIGPOS();
        return $gpos->text();
    }
}
