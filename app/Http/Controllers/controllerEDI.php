<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EdiLP;
use App\EdiHUB;
use App\EdiSC;
use App\EdiCO;
use Carbon\Carbon;
use App\Text\EDI;
use Storage;
use Jenssegers\Date\Date;

//use EDI;
class controllerEDI extends Controller
{    
    public function __construct()
    {
        $this->middleware('Check',['only'=>'index']);
        $this->middleware('EDI852',['only'=>'index']);        
    }
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
            $characters=array('Cochabamba','LaPaz','SantaCruz','Hub','_','.txt');
            $date = str_replace($characters,"",$file);
            array_push($average,['name'=>$file,'fecha'=>ucwords(Date::parse($date)->format('l j F Y'))]);
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
    public function datos($city,$name){
         switch ($city) {
            case 'lapaz':
                $characters=array('Cochabamba','LaPaz','SantaCruz','Hub','_','.txt');
                $date = str_replace($characters,"",$name);
                return EdiLP::whereDate('Fecha',Carbon::parse($date)->format('Y-m-d'))->orderBy('ItemCode')->get();       
            break;
            case 'santacruz':
                $characters=array('Cochabamba','LaPaz','SantaCruz','Hub','_','.txt');
                $date = str_replace($characters,"",$name);
                return EdiSC::whereDate('Fecha',Carbon::parse($date)->format('Y-m-d'))->orderBy('ItemCode')->get();             
            break;
            case 'cochabamba':
                $characters=array('Cochabamba','LaPaz','SantaCruz','Hub','_','.txt');                
                $date = str_replace($characters,"",$name);
                return EdiCO::whereDate('Fecha',Carbon::parse($date)->format('Y-m-d'))->orderBy('ItemCode')->get();                               
            break;
            case 'hub':
                $characters=array('Cochabamba','LaPaz','SantaCruz','Hub','_','.txt');                
                $date = str_replace($characters,"",$name);
                return EdiHUB::whereDate('Fecha',Carbon::parse($date)->format('Y-m-d'))->orderBy('ItemCode')->get();      
            break;
        }
       
    }
    public function edis($city,$date){
        $edi=new EDI;
        $datef=Carbon::parse($date)->format('Ymd');
        switch ($city) {
            case 'lapaz':
                Storage::disk('edi')->put('\LaPaz\LaPaz_'.$datef.'.txt', $edi->text_lp($date));            
            break;
            case 'santacruz':
                Storage::disk('edi')->put('\SantaCruz\SantaCruz_'.$datef.'.txt', $edi->text_sc($date));                                 
            break;
            case 'cochabamba':
                Storage::disk('edi')->put('\Cochabamba\Cochabamba_'.$datef.'.txt', $edi->text_co($date));                                  
            break;
            case 'hub':
                Storage::disk('edi')->put('\Hub\Hub_'.$datef.'.txt', $edi->text_hub($date));        
            break;
        }
    }
}
