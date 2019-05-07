<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EdiLP;
use Carbon\Carbon;
use App\Text\EDI;
use Storage;
//use EDI;
class controllerEDI extends Controller
{    
    public function index(){  
        return view('panel.registros.edi.index');
    }
    public function archivos($city){
        $average=array();
        switch ($city) {
            case 'lapaz':
                $files=Storage::disk('ediLP')->files();         
            break;
            case 'santacruz':
                $files=Storage::disk('ediSC')->files();                               
            break;
            case 'cochabamba':
                $files=Storage::disk('ediCO')->files();                          
            break;
            case 'hub':
                $files=Storage::disk('ediHUB')->files();  
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
                return Storage::disk('ediLP')->download($name);          
            break;
            case 'santacruz':
                return Storage::disk('ediSC')->download($name);                               
            break;
            case 'cochabamba':
                return Storage::disk('ediCO')->download($name);                              
            break;
            case 'hub':
                return Storage::disk('ediHUB')->download($name);      
            break;
        }
    }
    public function edis($city){
        $edi=new EDI;
        $date=Carbon::now()->format('Ymd');
        switch ($city) {
            case 'lapaz':
                Storage::disk('edi')->put('\LaPaz\LaPaz_'.$date.'.txt', $edi->text_lp());            
            break;
            case 'santacruz':
                Storage::disk('edi')->put('\SantaCruz\SantaCruz_'.$date.'.txt', $edi->text_sc());                                 
            break;
            case 'cochabamba':
                Storage::disk('edi')->put('\Cochabamba\Cochabamba_'.$date.'.txt', $edi->text_co());                                  
            break;
            case 'hub':
                Storage::disk('edi')->put('\Hub\Hub_'.$date.'.txt', $edi->text_hub());        
            break;
        }
    }
}
