<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Hana\SQL\DMI;
use App\Mail\Edi\DMI as MAILDMI;
use Mail;
class CommandDMI extends Command
{
    protected $signature = 'DMI:start';

    protected $description = 'Truncate and Call Procedure SAP HANA';

    public $DMI;
    public function __construct(){
        parent::__construct();
        $this->DMI=new DMI();
    }
    public function handle(){
        $truncate=$this->DMI->truncate();
        $call=$this->DMI->call();
        Mail::send(new MAILDMI($truncate,$call));
        $this->info($truncate);
        $this->info($call);
    }
}
