<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Text\GPOS as BUILDGPOS;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SSH;
class controllerGPOSv2 extends Controller
{
    public function data(){
        $commands=[
            'cd /opt/alfresco-community/postgresql/bin/',
            'PGPASSWORD="Manager1" ./pg_dump -U alfresco alfresco > db.sql',
            'ls -l'
        ];
        SSH::run($commands, function($line){
            echo $line.PHP_EOL;
        });
        SSH::get("/opt/alfresco-community/postgresql/bin/db.sql", \base_path().'\public\archivos\db.sql');
    }
    public function acuerdos(){
        return $users = DB::table('LTA_RA_DETALLE')->where('Name','440TAKEYS100D')->get();
    }
}
