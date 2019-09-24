<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text\GPOS as BUILDGPOS;
use App\GPOS;
use Carbon\Carbon;
class controllerGPOSv2 extends Controller
{
    public $start;
    public $end;
    public function data(){
        $build=new BUILDGPOS;
        $this->end= new Carbon('last saturday');
        Carbon::setTestNow($this->end);       
        $this->start=new Carbon('last sunday');
        Carbon::setTestNow();   
        $this->now=Carbon::now()->format('Ymd');
        $gpos=GPOS::whereDate('DocDate','>=',$this->start)->whereDate('DocDate','<=',$this->end)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->get();
        return $build->CardCode($gpos);
    }
}
