<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text\EDIGPOS;
use App\Text\EDI;
use App\GPOS;
use Mail;
use App\Mail\Edi\Success;
use App\Mail\Edi\Failure;
use App\Mail\Gpos\Failure as FailureGPOS;
use App\Mail\Gpos\Success as SuccessGPOS;
use App\Mail\Gpos\SuccessExcel as SuccessGPOSExcel;
use Carbon\Carbon;
use Storage;
use Excel;
use App\Exports\GposExport;
class controllerGPOS extends Controller
{
    public function datos(){   
        $nextSaturday= new Carbon('last saturday');
        Carbon::setTestNow($nextSaturday);       
        $lastSunday=new Carbon('last sunday');
        Carbon::setTestNow();
        return Gpos::whereDate('DocDate','>=',$lastSunday)->whereDate('DocDate','<=',$nextSaturday)->get();
    }
    public function excel()
    {
        $nextSaturday= new Carbon('last saturday');
        Carbon::setTestNow($nextSaturday);       
        $lastSunday=new Carbon('last sunday');
        Carbon::setTestNow();
        Excel::store(new GposExport($lastSunday,$nextSaturday), 'GPOS'.$lastSunday->format('Y-m-d').'a'.$nextSaturday->format('Y-m-d').'.xlsx','gposExcel');
        return Excel::download(new GposExport($lastSunday,$nextSaturday), 'GPOS'.$lastSunday->format('Y-m-d').'a'.$nextSaturday->format('Y-m-d').'.xlsx');
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
            case 'general':
                $files=Storage::disk('gposExcel')->files();                          
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
            case 'general':
                return Storage::disk('gposExcel')->download($name);                              
            break;
        }
    }
    public function gpos(Request $request){
        $gpos=new EDIGPOS;
        $start=Carbon::parse($request->start);
        $end=Carbon::parse($request->end);
        switch ($request->city) {
            case 'lapaz':
                Storage::disk('gposLP')->put('\LaPaz_'.$start->format('Ymd').'a'.$end->format('Ymd').'.txt', $gpos->text_date('LARCOS000','0000863151',$start,$end));            
            break;
            case 'santacruz':
                Storage::disk('gposSC')->put('\SantaCruz_'.$start->format('Ymd').'a'.$end->format('Ymd').'.txt', $gpos->text_date('LARCOS001','0000863153',$start,$end));            
            break;
            case 'cochabamba':
                Storage::disk('gposCO')->put('\Cochabamba_'.$start->format('Ymd').'a'.$end->format('Ymd').'.txt', $gpos->text_date('LARCOS002','0000863152',$start,$end));            
            break;
            case 'general':
                Excel::store(new GposExport($start,$end), 'GPOS'.$start->format('Y-m-d').'a'.$end->format('Y-m-d').'.xlsx','gposExcel');
            break;
        }
    }
}
