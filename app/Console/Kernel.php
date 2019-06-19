<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\Edi\Success;
use App\Mail\Edi\Failure;
use App\Mail\Gpos\Failure as FailureGPOS;
use App\Mail\Gpos\Success as SuccessGPOS;
use App\Mail\Gpos\SuccessExcel as SuccessGPOSExcel;
use App\Text\EDIGPOS;
use App\Text\EDI;
use Mail;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        
    ];
    protected function scheduleTimezone()
    {
        return 'America/La_Paz';
    }
    protected function schedule(Schedule $schedule)
    { 
        $schedule->command('edi:send')
                 ->dailyAt('22:00')
                 ->onSuccess(function () {
                    $edi=new EDI;
                    $count=$edi->count();
                    $names=$edi->names();
                    Mail::send(new Success($count,$names));
                  })
                 ->onFailure(function () {
                    Mail::send(new Failure);
                  });
        $schedule->command('gpos:send')
                 ->weeklyOn(7, '23:00')
                 ->onSuccess(function () {
                    $gpos=new EDIGPOS;
                    $counts=$gpos->counts();
                    $names=$gpos->names();
                    $count=$gpos->count();
                    $name=$gpos->name();
                    Mail::send(new SuccessExcel($count,$name));
                    Mail::send(new Success($counts,$names));      
                  })
                 ->onFailure(function () {
                    Mail::send(new Failure);
                  });
        $schedule->command('upc:null')
                 ->dailyAt('17:00');
    }
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
