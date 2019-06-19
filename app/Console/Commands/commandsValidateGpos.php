<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\FeOCClie;
use App\Track;
use App\UCP;
use App\Price;
use Carbon\Carbon;
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
        UPC::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','<=',$lastMonday)->get();
        FeOCClie::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->get();
        Price::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->get();
        Track::whereDate('DocDate','>=',$nextSaturday)->whereDate('DocDate','>=',$lastMonday)->get(); 
        Mail::send()
    }
}
