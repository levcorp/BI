<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\UPC_OITM;
use App\Mail\Edi\UPC_OITM as MailUPC;
use Carbon\Carbon;
class CommandUPC extends Command
{
    protected $signature = 'upc:null';
    protected $description = 'Articulos sin UPC generados';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        if(UPC_OITM::whereDate('CreateDate',Carbon::now())->count()>0){
            Mail::send(new MailUPC(UPC_OITM::whereDate('CreateDate',Carbon::now())->get()));
            $this->info('El correo fue enviado Correctamente');
        }else{
            $this->info('No existen articulos nulos de la fecha '.Carbon::now());
        }
    }
}
