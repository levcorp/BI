<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EdiLP;
use Carbon\Carbon;
use App\Text\EDI;
use Storage;
class controllerEDI extends Controller
{
    public function ediLP(){        
        $edi=new EDI;
        Storage::disk('edi')->put('\LaPaz\LaPaz_'.Carbon::now()->format('Ymd').'.txt', $edi->text_lp());        
    }    
    public function index(){  
        return view('panel.registros.edi.index');
    }
    public function archivosLP(){
        $average=array();
        $files=Storage::disk('ediLP')->files();
        foreach ($files as $file) {
            array_push($average,['name'=>$file]);
        }
        return response()->json($average);
    }
    public function downloadLP($name){
        return Storage::disk('ediLP')->download($name);
    }
}
