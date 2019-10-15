<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\FeOCClie;
use App\Track;
use App\UPC;
use App\Price;
use Carbon\Carbon;
use App\Mail\Gpos\Validacion;
class commandsValidateGpos extends Command
{

    protected $signature = 'gpos:validate';
    protected $description = 'Validacion de registros de facturacion';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $nextSaturday= Carbon::now();
        $lastMonday=new Carbon('last monday');
        Carbon::setTestNow();
        if(UPC::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','<=',$lastMonday)->count()==0 && FeOCClie::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->count()==0 && Price::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->count()==0 && Track::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->count()==0){
            $this->info('No hay ninguna validacion');
        }else {
            Mail::send( new Validacion(
                UPC::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','<=',$lastMonday)->get(),
                FeOCClie::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->get(),
                Price::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->get(),
                Track::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->get(),
                UPC::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','<=',$lastMonday)->count(),
                FeOCClie::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->count(),
                Price::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->count(),
                Track::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->count(),
            ));
            $this->info('Validacion realizada');
        }
    }
}
