<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SpeedTest;
class CommandSpeedTest extends Command
{

    protected $signature = 'speedTest:start';
    protected $description = 'Ejecucion del commando speed-test';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
      shell_exec('C:\Users\Administrador\AppData\Local\Programs\Python\Python38-32\Scripts\speedtest-cli --simple >'.base_path().'\public\archivos\speedtest\\'.date('Ymd').'.txt');
      //shell_exec('C:\Users\angel\AppData\Roaming\Python\Python38\Scripts\speedtest-cli --simple >'.base_path().'\public\archivos\speedtest\\'.date('Ymd').'.txt');
      sleep(40);
      $archivo = fopen(base_path().'\public\archivos\speedtest\\'.date('Ymd').'.txt', "r");
      $count=0;
      $data=array();
      while(!feof($archivo)){
        $strings = array("Ping:", "Download:", "Upload:", " ", "ms","Mbit/s");
        $data[$count]=str_replace($strings, "",fgets($archivo));
        $count++;
      }
      fclose($archivo);
      SpeedTest::create([
        'ping'=>$data[0],
        'download'=>$data[1],
        'upload'=>$data[2],
        'fecha'=>date('Y-m-d')
      ]);
    }
}
