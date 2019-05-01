<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\Articulos;
use App\DetalleSolicitud;
use App\User;
class CommandEDI extends Command
{
    protected $signature = 'edi:send';
    protected $description = 'Generacion de codigo EDI';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $para='gpinto@levcorp.bo';
        $articulos=DetalleSolicitud::all();
        $usuario=User::findOrFail('1');   
        Mail::to($para)->send( new Articulos($articulos,$usuario));
    }
}
