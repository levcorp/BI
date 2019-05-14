<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text\EDIGPOS;
use App\Text\EDI;
use App\GPOS;
use Mail;
use App\Mail\Edi\Success;
use App\Mail\Edi\Failure;
use Carbon\Carbon;
use Storage;
class controllerGPOS extends Controller
{
    public function datos()
    {   
        $edi=new EDI;
        //$datef=Carbon::yesterday()->format('Ymd');
        //$date=Carbon::yesterday()->format('Y-m-d');
        $datef=Carbon::now()->format('Ymd');
        $date=Carbon::now()->format('Y-m-d');
        Storage::disk('edi')->put('\LaPaz\LaPaz_'.$datef.'.txt', $edi->text_lp($date));            
        Storage::disk('EDIftp')->put('\LaPaz_'.$datef.'.txt', $edi->text_lp($date));            
        Storage::disk('edi')->put('\SantaCruz\SantaCruz_'.$datef.'.txt', $edi->text_sc($date)); 
        Storage::disk('EDIftp')->put('\SantaCruz_'.$datef.'.txt', $edi->text_sc($date));            
        Storage::disk('edi')->put('\Cochabamba\Cochabamba_'.$datef.'.txt', $edi->text_co($date));                                  
        Storage::disk('EDIftp')->put('\Cochabamba_'.$datef.'.txt', $edi->text_co($date));            
        Storage::disk('edi')->put('\Hub\Hub_'.$datef.'.txt', $edi->text_hub($date));      
        Storage::disk('EDIftp')->put('\Hub_'.$datef.'.txt', $edi->text_hub($date));  
    }
    public function archivos($city){
        $average=array();
        switch ($city) {
            case 'lapaz':
                $files=Storage::disk('gposLP')->files();         
            break;
            case 'santacruz':
                $files=Storage::disk('gposSC')->files();                               
            break;
            case 'cochabamba':
                $files=Storage::disk('gposCO')->files();                          
            break;
        }
        foreach ($files as $file) {
            array_push($average,['name'=>$file]);
        }
        return response()->json($average);
    }
    public function download($city,$name){
        switch ($city) {
            case 'lapaz':
                return Storage::disk('gposLP')->download($name);          
            break;
            case 'santacruz':
                return Storage::disk('gposSC')->download($name);                               
            break;
            case 'cochabamba':
                return Storage::disk('gposCO')->download($name);                              
            break;
        }
    }
    public function gpos($city){
        $edi=new EDIGPOS;
        $lastMonday= new Carbon('last monday');
        Carbon::setTestNow($lastMonday);       
        $lastSunday=new Carbon('last sunday');
        $nextSaturday=new Carbon('next saturday');
        Carbon::setTestNow();    
        switch ($city) {
            case 'lapaz':
                Storage::disk('gposLP')->put('\LaPaz_'.$lastSunday->format('Ymd').'to'.$nextSaturday->format('Ymd').'.txt', $edi->text_lp());            
            break;
            case 'santacruz':
                //Storage::disk('gposCO')->put('\SantaCruz_'.$datef.'.txt', $edi->text_sc());                                 
            break;
            case 'cochabamba':
                //Storage::disk('gposSC')->put('\Cochabamba_'.$datef.'.txt', $edi->text_co());                                  
            break;
        }
    }
}
